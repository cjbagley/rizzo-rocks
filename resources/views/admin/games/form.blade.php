<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Game') }}
        </h2>
    </x-slot>

    <x-admin-card-holder>
        <x-admin-card>
            @if (!empty(session('game')))
            <p class="mt-2 font-medium text-sm text-green-600">
                {{ __("{session('game)->title} Added") }}
            </p>
            @endif
            @include('admin.games.partials.game-form')
        </x-admin-card>
    </x-admin-card-holder>
</x-admin-layout>
