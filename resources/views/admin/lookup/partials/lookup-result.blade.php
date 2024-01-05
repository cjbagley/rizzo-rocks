@forelse(session('data') as $game)
@if(!empty($game->name))
<x-admin-card>

    <div class="flex flex-col items-start md:flex-row hover:bg-gray-100">
        @if(!empty($game->getCoverImageUrl('t_thumb')))
        <img width="160" src="{{ $game->getCoverImageUrl('t_cover_big') }}" alt="{{ $game->name }}">
        @endif
        <div class="flex flex-col justify-between pl-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $game->name }}</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $game->summary }}</p>
            <ul class="text-sm w-full">
                <x-lookup-li label="Rating">{{ $game->rating >= 0 ? '-' : $game->rating . '/100' }}</x-lookup-li>
                <x-lookup-li label="Release Date">{{ $game->getReleaseDate() }}</x-lookup-li>
                <x-lookup-li label="Platforms">{{ empty($game->platforms) ? '-' : implode(', ', $game->platforms) }}</x-lookup-li>
                <x-lookup-li label="IGDB ID">{{ $game->id }}</x-lookup-li>
            </ul>
            @if(!empty($data->url))
            <small><a href="{{ $game->info_url }}">More Info</a></small>
            @endif
        </div>
    </div>

</x-admin-card>
@endif
@empty

<x-admin-card>
    No results found
</x-admin-card>
@endforelse
