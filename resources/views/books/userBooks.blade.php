@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-gradient-to-r from-primary to-tertiary rounded-2xl shadow-lg overflow-hidden mb-8">
        <div class="px-8 py-6">
            <h1 class="text-3xl font-bold text-lighter">Bibliothèque</h1>
            <div class="mt-4">
                <form method="GET" action="{{ route('books.index') }}">
                    <div class="flex items-center">
                        <input type="text"
                            name="search"
                            placeholder="Rechercher un livre..."
                            class="w-full px-4 py-2 rounded-l-lg border-0 focus:ring-2 focus:ring-primary/50"
                            value="{{ request('search') }}">
                        <button type="submit"
                            class="bg-tertiary text-white px-6 py-2 rounded-r-lg hover:bg-green-600 transition-all duration-300">
                            Rechercher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($books->isEmpty())
    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
        <div class="text-6xl mb-4">📚</div>
        <p class="text-gray-600">Aucun livre disponible pour le moment.</p>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($books as $book)
        @if ($book->quantity > 0)
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-bold text-primary mb-2">{{ $book->title }}</h2>
                <div class="space-y-3">
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <p>{{ $book->author }}</p>
                    </div>
                    <p class="text-gray-600">{{ $book->description }}</p>
                    <div class="flex items-center text-tertiary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <p class="font-medium">{{ $book->quantity }} livre(s) disponible(s)</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('borrowings.store') }}" class="mt-4">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <button type="submit"
                        class="w-full bg-tertiary text-white py-2 px-4 rounded-lg hover:bg-green-600 transition-all duration-300 transform hover:scale-105">
                        Emprunter
                    </button>
                </form>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <div class="mt-8">
        {{ $books->links() }}
    </div>
    @endif
</div>
@endsection