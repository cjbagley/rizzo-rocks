<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Games') }}
            </h2>
            <x-primary-button-link href="{{ route('games.create') }}">Add</x-primary-button-link>
        </div>
    </x-slot>

    <x-admin-card-holder>
        @forelse($games as $game)
        <x-admin-card>
            {{ $game->title }}
        </x-admin-card>
        @empty
        <x-admin-card>
            No games added yet!
        </x-admin-card>
        @endforelse
    </x-admin-card-holder>
</x-admin-layout>
