@extends('layouts.app')

@section('content')
<div class="min-h-screen flex">
    <div class="w-full lg:w-2/3 p-8">
        <div class="max-w-2xl mx-auto">
            <div class="text-center mb-8">
                <span class="text-5xl">📖</span>
                <h1 class="text-3xl font-bold text-primary mt-4">Modifier le livre</h1>
            </div>

            <form method="POST" action="{{ route('books.update', $book) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-2">
                    <label for="title" class="block text-sm font-medium text-primary">Titre du livre</label>
                    <input type="text"
                        name="title"
                        id="title"
                        value="{{ $book->title }}"
                        required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <div class="space-y-2">
                    <label for="author" class="block text-sm font-medium text-primary">Auteur</label>
                    <input type="text"
                        name="author"
                        id="author"
                        value="{{ $book->author }}"
                        required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-primary">Description</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">{{ $book->description }}</textarea>
                </div>

                <div class="space-y-2">
                    <label for="quantity" class="block text-sm font-medium text-primary">Quantité disponible</label>
                    <input type="number"
                        name="quantity"
                        id="quantity"
                        value="{{ $book->quantity }}"
                        required
                        min="1"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <div class="flex space-x-4 pt-4">
                    <button type="submit"
                        class="flex-1 bg-tertiary text-white py-3 rounded-lg hover:bg-green-600 transition-all duration-300 transform hover:scale-105 font-medium">
                        Mettre à jour
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
            <h2 class="text-3xl font-bold mb-4">Mise à jour du livre</h2>
            <p class="text-lg">Modifiez les informations du livre pour maintenir votre catalogue à jour</p>
        </div>
    </div>
</div>
@endsection