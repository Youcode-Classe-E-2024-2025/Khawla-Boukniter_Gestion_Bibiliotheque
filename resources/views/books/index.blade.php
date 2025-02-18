@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-gradient-to-r from-primary to-tertiary rounded-2xl shadow-lg overflow-hidden mb-8">
        <div class="px-8 py-6">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-lighter">Liste des livres</h1>
                <a href="{{ route('books.create') }}" class="bg-tertiary text-white py-2 px-4 rounded-lg hover:bg-green-600 transition-all duration-300 transform hover:scale-105">
                    Ajouter un livre
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-lighter">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-primary uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-primary uppercase tracking-wider">Titre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-primary uppercase tracking-wider">Auteur</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-primary uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-primary uppercase tracking-wider">Quantité</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-primary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($books as $book)
                    <tr class="hover:bg-lighter transition-colors">
                        <td class="px-6 py-4">{{ $book->id }}</td>
                        <td class="px-6 py-4">{{ $book->title }}</td>
                        <td class="px-6 py-4">{{ $book->author }}</td>
                        <td class="px-6 py-4">{{ $book->description }}</td>
                        <td class="px-6 py-4">{{ $book->quantity }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('books.edit', $book) }}" class="inline-block bg-primary text-white py-1 px-3 rounded-lg hover:bg-blue-700 transition-all duration-300">
                                Modifier
                            </a>
                            <form method="POST" action="{{ route('books.destroy', $book) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-secondary text-white py-1 px-3 rounded-lg hover:bg-red-700 transition-all duration-300" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection