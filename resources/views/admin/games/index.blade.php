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
            <div class="flex flex-col items-start md:flex-row hover:bg-gray-100 gap-5">
                {{--
                @if(!empty($game->getCoverImageUrl('t_thumb')))
                <img width="160" class="max-md:mx-auto" src="{{ $game->getCoverImageUrl('t_cover_big') }}" alt="{{ $game->name }}">
                @endif
                --}}
                <div class="flex flex-col justify-between max-md:pl-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $game->title }}</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $game->comments }}</p>
                    @if(!empty($game->url))
                    <small><a href="{{ $game->info_url }}">More Info</a></small>
                    @endif
                </div>
            </div>
        </x-admin-card>
        @empty
        <x-admin-card>
            No games added yet!
        </x-admin-card>
        @endforelse
    </x-admin-card-holder>
</x-admin-layout>
