<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\User;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with('user', 'book')->paginate(6);
        return view('borrowings.index', ['borrowings' => $borrowings]);
    }

    public function store(Request $request)
    {
        $request->validate(['book_id' => 'required|exists:books,id']);
        $book = Book::findOrFail($request->book_id);

        if ($book->quantity <= 0) {
            return redirect()->back()->with('error', 'Book unavailable');
        }

        Borrowing::create([
            'user_id' => Auth::user()->id,
            'book_id' => $request->book_id,
            'borrowed_at' => now(),
        ]);

        $book->decrement('quantity');

        return redirect()->route('borrowings.index')->with('success', 'Book borrowed successfully');
    }

    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->returned_at) {
            return back()->withErrors(['returned_at' => 'Already returned']);
        }

        $borrowing->update(['returned_at' => now()]);

        $book = $borrowing->book;
        $book->increment('quantity');

        return redirect()->route('borrowings.index')->with('success', 'Return registered');
    }

    public function management()
    {
        $statistics = [
            'totalBooks' => Book::count(),
            'activeUsers' => User::count(),
            'currentBorrowings' => Borrowing::whereNull('returned_at')->count(),
            'overdueBorrowings' => Borrowing::whereNull('returned_at')
                ->where('borrowed_at', '<', now()->subDays(14))
                ->count()
        ];

        $recentBorrowings = Borrowing::with(['user', 'book'])
            ->latest()->paginate(10);

        return view('borrowings.management', compact('statistics', 'recentBorrowings'));
    }
}
