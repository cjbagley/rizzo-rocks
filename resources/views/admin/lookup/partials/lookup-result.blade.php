@forelse(session('data') as $game)
    @if(!empty($game->name))
        <x-admin-card>
            <div class="game-info-wrapper">
                @if(!empty($game->getCoverImageUrl(App\Enums\ImageSize::Cover_big)))
                    <img width="160" src="{{ $game->getCoverImageUrl(App\Enums\ImageSize::Cover_big) }}"
                         alt="{{ $game->name }}">
                @endif
                <div class="game-info-details">
                    <h3>{{ $game->name }}</h3>
                    <p>{{ $game->summary }}</p>
                    <ul>
                        <x-lookup-li
                                label="Rating">{{ $game->rating >= 0 ? '-' : $game->rating . '/100' }}</x-lookup-li>
                        <x-lookup-li label="Release Date">{{ $game->getReleaseDate() }}</x-lookup-li>
                        <x-lookup-li
                                label="Platforms">{{ empty($game->platforms) ? '-' : implode(', ', $game->platforms) }}</x-lookup-li>
                        <x-lookup-li label="IGDB ID">{{ $game->id }}</x-lookup-li>
                    </ul>
                    @if(!empty($data->url))
                        <small><a
                                    target="_new" rel="noreferrer"
                                    href="{{ $game->info_url }}">More Info</a></small>
                    @endif
                </div>
            </div>
            <div class="btn-container">
                <x-secondary-button-link href="{{ route('games.create', ['lookup-id'=> $game->id]) }}">Add
                </x-secondary-button-link>
            </div>
        </x-admin-card>
    @endif
@empty

    <x-admin-card>
        No results found
    </x-admin-card>
@endforelse
