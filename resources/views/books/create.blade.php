@extends('layouts.app')

@section('content')
<div class="min-h-screen flex">
    <div class="w-full lg:w-2/3 p-8">
        <div class="max-w-2xl mx-auto">
            <div class="text-center mb-8">
                <span class="text-5xl">📚</span>
                <h1 class="text-3xl font-bold text-primary mt-4">Ajouter un nouveau livre</h1>
            </div>

            <form method="POST" action="{{ route('books.store') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label for="title" class="block text-sm font-medium text-primary">Titre du livre</label>
                    <input type="text"
                        name="title"
                        id="title"
                        required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                        placeholder="Le titre du livre">
                </div>

                <div class="space-y-2">
                    <label for="author" class="block text-sm font-medium text-primary">Auteur</label>
                    <input type="text"
                        name="author"
                        id="author"
                        required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                        placeholder="Nom de l'auteur">
                </div>

                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-primary">Description</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                        placeholder="Description du livre"></textarea>
                </div>

                <div class="space-y-2">
                    <label for="quantity" class="block text-sm font-medium text-primary">Quantité disponible</label>
                    <input type="number"
                        name="quantity"
                        id="quantity"
                        required
                        min="1"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                        placeholder="Nombre d'exemplaires">
                </div>

                <div class="flex space-x-4 pt-4">
                    <button type="submit"
                        class="flex-1 bg-tertiary text-white py-3 rounded-lg hover:bg-green-600 transition-all duration-300 transform hover:scale-105 font-medium">
                        Ajouter le livre
                    </button>
                    <a href="{{ route('books.index') }}"
                        class="flex-1 bg-secondary text-white py-3 rounded-lg hover:bg-red-700 transition-all duration-300 transform hover:scale-105 font-medium text-center">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="hidden lg:flex lg:w-1/3 bg-primary items-center justify-center">
        <div class="text-center text-white p-8">
            <h2 class="text-3xl font-bold mb-4">Enrichissez votre collection</h2>
            <p class="text-lg">Ajoutez de nouveaux livres à votre bibliothèque pour les partager avec vos lecteurs</p>
        </div>
    </div>
</div>
@endsection