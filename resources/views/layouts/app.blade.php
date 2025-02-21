<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2B6777',
                        secondary: '#C84B31',
                        tertiary: '#52734D',
                        light: '#FFFFFF',
                        lighter: '#F5F5F5',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-lighter">
    <nav class="bg-gradient-to-r from-primary to-tertiary shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('welcome') }}" class="text-2xl font-bold text-lighter hover:text-light transition-all duration-300">
                    Bibliothèque
                </a>

                <ul class="flex items-center space-x-8">
                    @if (auth()->check())
                    <li class="relative group">
                        <div class="py-2">
                            <button class="flex items-center space-x-3 focus:outline-none">
                                <div class="relative">
                                    <div class="w-10 h-10 bg-gradient-to-r from-primary to-tertiary rounded-full p-[2px]">
                                        <div class="w-full h-full bg-lighter rounded-full flex items-center justify-center">
                                            <span class="text-primary font-bold text-lg">
                                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-tertiary border-2 border-lighter rounded-full"></div>
                                </div>

                                <div class="text-left">
                                    <p class="text-lighter font-medium">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-light/80">{{ auth()->user()->role }}</p>
                                </div>

                                <svg class="w-5 h-5 text-lighter transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>

                        <div class="absolute z-10 right-0 w-48 bg-white rounded-xl shadow-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                            <a href="{{ route('books.index') }}" class="block px-4 py-2 text-primary hover:bg-lighter transition-colors">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <span>@if (auth()->user()->role === 'admin') Gestion des Livres @else Livres @endif</span>
                                </div>
                            </a>

                            @if (auth()->user()->role === 'admin')

                            <a href="{{ route('borrowings.management') }}" class="block px-4 py-2 text-primary hover:bg-lighter transition-colors">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <span>Gestion des Emprunts</span>
                                </div>
                            </a>

                            @else
                            <a href="{{ route('borrowings.index') }}" class="block px-4 py-2 text-primary hover:bg-lighter transition-colors">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <span>Mes Emprunts</span>
                                </div>
                            </a>

                            @endif

                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-primary hover:bg-lighter transition-colors">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>Mon Profil</span>
                                </div>
                            </a>

                            <div class="border-t border-gray-100 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-secondary hover:bg-lighter transition-colors">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        <span>Déconnexion</span>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('login') }}" class="bg-lighter text-primary px-4 py-2 rounded-lg hover:bg-light transition-all duration-300 transform hover:scale-105">
                            Connexion
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="bg-primary text-lighter px-4 py-2 rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                            Inscription
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-lg">
            @yield('content')
        </div>
    </main>

    <footer class="bg-gradient-to-r from-primary to-tertiary text-lighter mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center">&copy; {{ date('Y') }} Bibliothèque. Tous droits réservés.</p>
        </div>
    </footer>
</body>

</html>