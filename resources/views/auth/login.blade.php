@extends('layouts.app')

@section('content')
<div class="min-h-screen flex">
    <div class="hidden lg:flex lg:w-1/2 bg-primary items-center justify-center">
        <div class="text-center text-white p-8">
            <h2 class="text-4xl font-bold mb-4">Bienvenue dans votre Bibliothèque</h2>
            <p class="text-xl">Découvrez notre collection de livres exceptionnels</p>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center bg-lighter p-8">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <span class="text-5xl">📚</span>
                <h1 class="text-3xl font-bold text-primary mt-4">Connexion</h1>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-primary">Email</label>
                    <div class="relative">
                        <input type="email"
                            name="email"
                            id="email"
                            required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                            placeholder="votre@email.com">
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-primary">Mot de passe</label>
                    <div class="relative">
                        <input type="password"
                            name="password"
                            id="password"
                            required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                            placeholder="••••••••">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-primary text-white py-3 rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 font-medium">
                    Se connecter
                </button>

                <p class="text-center text-gray-600 mt-4">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-primary hover:text-blue-700 font-medium">
                        S'inscrire
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection