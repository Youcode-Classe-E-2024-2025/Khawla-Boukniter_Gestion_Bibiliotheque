@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-gradient-to-r from-primary to-tertiary rounded-2xl shadow-lg overflow-hidden mb-8">
        <div class="px-8 py-6">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-lighter rounded-full flex items-center justify-center">
                    <span class="text-3xl font-bold text-primary">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-lighter">
                        {{ Auth::user()->role === 'admin' ? 'Tableau de bord Administrateur' : 'Mon Espace Personnel' }}
                    </h1>
                    <p class="text-light/80">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::user()->role === 'admin')
    <div class="space-y-8">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-primary/10 rounded-full">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-600 text-sm">Total Livres</h2>
                        <p class="text-2xl font-bold text-primary">{{ $statistics['totalBooks'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-tertiary/10 rounded-full">
                        <svg class="w-8 h-8 text-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-600 text-sm">Utilisateurs Actifs</h2>
                        <p class="text-2xl font-bold text-tertiary">{{ $statistics['activeUsers'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-600 text-sm">Emprunts en Cours</h2>
                        <p class="text-2xl font-bold text-blue-500">{{ $statistics['currentBorrowings'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-primary mb-4">Actions Rapides</h2>
                <div class="space-y-4">
                    <a href="{{ route('books.create') }}"
                        class="flex items-center justify-center space-x-2 w-full bg-tertiary text-white p-3 rounded-lg hover:bg-green-600 transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>Ajouter un nouveau livre</span>
                    </a>
                    <a href="{{ route('borrowings.index') }}"
                        class="flex items-center justify-center space-x-2 w-full bg-primary text-white p-3 rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span>Gérer les emprunts</span>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-primary mb-4">Emprunts Récents</h2>
                <div class="space-y-4">
                    @foreach($recentBorrowings as $borrowing)
                    <div class="flex items-center space-x-3 p-3 bg-lighter rounded-lg">
                        <div class="p-2 bg-primary/10 rounded-full">
                            <span class="text-primary font-medium">
                                {{ strtoupper(substr($borrowing->user->name, 0, 1)) }}
                            </span>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <p class="text-sm font-medium text-gray-900">{{ $borrowing->book->title }}</p>
                                <p class="text-xs text-gray-500">{{ $borrowing->borrowed_at }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    @else
    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-primary mb-4">Mes Emprunts en cours</h2>
            @if($current->isEmpty())
            <div class="text-center py-8">
                <span class="text-6xl">📚</span>
                <p class="text-gray-600 mt-4">Aucun emprunt en cours</p>
            </div>
            @else
            <div class="space-y-4">
                @foreach($current as $borrowing)
                <div class="p-4 bg-lighter rounded-lg">
                    <h3 class="font-semibold text-primary">{{ $borrowing->book->title }}</h3>
                    <p class="text-sm text-gray-600">Emprunté le: {{ $borrowing->borrowed_at->format('d/m/Y') }}</p>
                    <form method="POST" action="{{ route('borrowings.return', $borrowing) }}" class="mt-2">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="text-tertiary hover:text-green-600 text-sm">
                            Marquer comme retourné
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-primary mb-4">Mon Historique</h2>
            @if($passed->isEmpty())
            <div class="text-center py-8">
                <span class="text-6xl">📖</span>
                <p class="text-gray-600 mt-4">Aucun historique disponible</p>
            </div>
            @else
            <div class="space-y-4">
                @foreach($passed as $borrowing)
                <div class="p-4 bg-lighter rounded-lg">
                    <h3 class="font-semibold text-primary">{{ $borrowing->book->title }}</h3>
                    <p class="text-sm text-gray-600">
                        Emprunté le: {{ $borrowing->borrowed_at->format('d/m/Y') }} <br>
                        Retourné le: {{ $borrowing->returned_at->format('d/m/Y') }}
                    </p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
    @endif
</div>
@endsection