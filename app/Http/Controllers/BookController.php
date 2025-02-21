<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    private $user;

    public function __construct(UserController $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'ilike', '%' . $search . '%')
                ->orWhere('author', 'ilike', '%' . $search . '%')
                ->orWhere('description', 'ilike', '%' . $search . '%');
        }

        $books = $query->paginate(6);

        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('books.index', ['books' => $books]);
        } else {
            return view('books.userBooks', ['books' => $books]);
        }
    }

    public function create()
    {
        $this->user->checkAdmin();
        return view('books.create');
    }

    public function store(Request $request)
    {
        $this->user->checkAdmin();

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'quantity' => 'required|integer',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function edit(Book $book)
    {
        $this->user->checkAdmin();

        return view('books.edit', ['book' => $book]);
    }

    public function update(Request $request, Book $book)
    {
        $this->user->checkAdmin();

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'quantity' => 'required|integer',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $this->user->checkAdmin();

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

    public function show(Book $book)
    {
        $book->load('borrowings');
        return view('books.show', compact('book'));
    }
}
