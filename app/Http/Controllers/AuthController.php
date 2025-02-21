<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Borrowing;
use App\Models\Book;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('profile')->with('success', 'Registration successful!');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('profile')->with('success', 'Login successful!');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logout successful!');
    }

    public function showProfile()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $statistics = [
                'totalBooks' => Book::count(),
                'activeUsers' => User::count(),
                'currentBorrowings' => Borrowing::whereNull('returned_at')->count(),
                'overdueBorrowings' => Borrowing::whereNull('returned_at')
                    ->where('borrowed_at', '<', now()->subDays(14))
                    ->count()
            ];

            $recentBorrowings = Borrowing::with(['user', 'book'])
                ->latest('borrowed_at')
                ->take(3)
                ->get();

            // dd($recentBorrowings);

            return view('auth.profile', compact('statistics', 'recentBorrowings'));
        } else {
            $current = Borrowing::with('book')
                ->where('user_id', $user->id)
                ->whereNull('returned_at')
                ->get();

            $passed = Borrowing::with('book')
                ->where('user_id', $user->id)
                ->whereNotNull('returned_at')
                ->latest()->limit(3)->get();

            return view('auth.profile', compact('current', 'passed'));
        }
    }
}
