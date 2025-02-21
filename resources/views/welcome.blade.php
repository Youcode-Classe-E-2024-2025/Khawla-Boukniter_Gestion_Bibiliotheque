@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-primary to-tertiary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    Bienvenue à votre Bibliothèque
                </h1>
                <p class="text-xl text-white/80 mb-8">
                    Découvrez notre collection de livres et commencez votre voyage littéraire
                </p>
                <div class="space-x-4">
                    @guest
                    <a href="{{ route('register') }}" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-lighter transition-colors">
                        Commencer
                    </a>
                    <a href="{{ route('login') }}" class="bg-white/10 text-white px-8 py-3 rounded-lg font-semibold hover:bg-white/20 transition-colors">
                        Se connecter
                    </a>
                    @else
                    <a href="{{ route('books.index') }}" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-lighter transition-colors">
                        Voir les livres
                    </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900 mb-2">Large Collection</h2>
                <p class="text-gray-600">Accédez à une vaste collection de livres dans différents domaines.</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="w-12 h-12 bg-tertiary/10 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900 mb-2">Emprunts Faciles</h2>
                <p class="text-gray-600">Empruntez et gérez vos livres en quelques clics.</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="w-12 h-12 bg-secondary/10 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900 mb-2">Recherche Simple</h2>
                <p class="text-gray-600">Trouvez rapidement les livres qui vous intéressent.</p>
            </div>
        </div>
    </div>

    <!-- Latest Books Section -->
    <div class="bg-lighter py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Derniers Ajouts</h2>
            <div class="grid md:grid-cols-4 gap-6">
                @foreach($latestBooks ?? [] as $book)
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $book->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ $book->author }}</p>
                    <a href="{{ route('books.index') }}" class="text-primary hover:text-primary-dark font-medium">
                        En savoir plus →
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection