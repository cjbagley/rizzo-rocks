<x-admin-layout :header="$header??''">
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Games') }}
            </h2>
            @if(!empty(session('success')))
            <div class="text-green-800">{{ session('success') }}</div>
            @endif
            <x-primary-button-link href="{{ route('games.create') }}">Add</x-primary-button-link>
        </div>
    </x-slot>

    <x-admin-card-holder>
        @forelse($games as $game)
        <x-admin-card>
            <div class="flex flex-col items-start md:flex-row gap-5">
                @if(!empty($game->getCoverImageUrl()))
                <img width="160" class="max-md:mx-auto" src="{{ $game->getCoverImageUrl() }}" alt="{{ $game->title }}">
                @endif
                <div class="flex flex-col justify-between max-md:pl-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $game->title }}</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $game->comments }}</p>
                    @if(!empty($game->url))
                    <small><a href="{{ $game->info_url }}">More Info</a></small>
                    @endif
                </div>
            </div>
            <div class="flex justify-end space-x-5">
                <x-secondary-button-link href="{{ route('games.edit', $game) }}">Edit</x-secondary-button-link>
                <x-secondary-button-link href="{{ route('captures.index', $game) }}">Captures</x-secondary-button-link>
                <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-game-deletion-{{$game->slug}}')">{{ __('Delete') }}</x-danger-button>
            </div>
            <x-modal name="confirm-game-deletion-{{$game->slug}}" :show="$errors->gameDeletion->isNotEmpty()" focusable>
                <form method="post" action="{{ route('games.destroy', $game) }}" class="p-6">
                    @csrf
                    @method('delete')

                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Are you sure you want to delete this game?') }}
                    </h2>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-danger-button class="ms-3">
                            {{ __('Delete') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
        </x-admin-card>
        @empty
        <x-admin-card>
            No games added yet!
        </x-admin-card>
        @endforelse
    </x-admin-card-holder>
</x-admin-layout>