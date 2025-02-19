@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-gradient-to-r from-primary to-tertiary rounded-2xl shadow-lg overflow-hidden mb-8">
        <div class="px-8 py-6">
            <h1 class="text-3xl font-bold text-lighter">Historique des Emprunts</h1>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($borrowings as $borrowing)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                        <span class="text-xl font-bold text-primary">
                            {{ strtoupper(substr($borrowing->book->title, 0, 1)) }}
                        </span>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-primary">{{ $borrowing->book->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $borrowing->book->author }}</p>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-sm">Emprunté le: {{ $borrowing->borrowed_at }}</span>
                    </div>

                    <div class="flex items-center">
                        @if (!$borrowing->returned_at)
                        <span class="px-3 py-1 bg-tertiary/10 text-tertiary rounded-full text-sm">
                            En cours
                        </span>
                        @else
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-sm">Retourné le: {{ $borrowing->returned_at }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                @if (!$borrowing->returned_at)
                <div class="mt-4">
                    <form method="POST" action="{{ route('borrowings.return', $borrowing) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="w-full bg-tertiary text-white py-2 px-4 rounded-lg hover:bg-green-600 transition-all duration-300">
                            Marquer comme retourné
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection