@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-primary to-tertiary px-8 py-6">
            <h1 class="text-3xl font-bold text-lighter">Détails du Livre</h1>
        </div>

        <div class="p-8">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <h2 class="text-2xl font-bold text-primary mb-2">{{ $book->title }}</h2>
                        <p class="text-lg text-gray-600">par {{ $book->author }}</p>
                    </div>

                    <div class="bg-lighter rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-primary mb-3">Description</h3>
                        <p class="text-gray-600">{{ $book->description }}</p>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="bg-tertiary/10 rounded-lg px-4 py-2">
                            <span class="text-sm text-tertiary font-medium">
                                {{ $book->quantity }} exemplaire(s) disponible(s)
                            </span>
                        </div>
                    </div>

                    @if(auth()->check() && $book->quantity > 0)
                    <form method="POST" action="{{ route('borrowings.store') }}" class="mt-6">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit" class="w-full bg-tertiary text-white py-3 px-6 rounded-lg hover:bg-green-600 transition-all duration-300">
                            Emprunter ce livre
                        </button>
                    </form>
                    @elseif(!auth()->check())
                    <a href="{{ route('login') }}" class="block text-center w-full bg-primary text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition-all duration-300">
                        Se connecter pour emprunter
                    </a>
                    @endif
                </div>

                <div class="space-y-6">
                    <h3 class="text-xl font-semibold text-primary">Historique des emprunts</h3>
                    @if($book->borrowings->isEmpty())
                    <p class="text-gray-600">Aucun emprunt pour ce livre.</p>
                    @else
                    <div class="space-y-4">
                        @foreach($book->borrowings as $borrowing)
                        <div class="bg-lighter rounded-lg p-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-600">
                                        Emprunté le: {{ $borrowing->borrowed_at->format('d/m/Y') }}
                                    </p>
                                    @if($borrowing->returned_at)
                                    <p class="text-sm text-tertiary">
                                        Retourné le: {{ $borrowing->returned_at->format('d/m/Y') }}
                                    </p>
                                    @endif
                                </div>
                                <span class="px-3 py-1 text-xs font-medium rounded-full 
                                            {{ $borrowing->returned_at ? 'bg-gray-100 text-gray-600' : 'bg-tertiary/10 text-tertiary' }}">
                                    {{ $borrowing->returned_at ? 'Retourné' : 'En cours' }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection