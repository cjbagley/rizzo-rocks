<x-admin-layout :header="$header??''">
    <x-admin-card-holder>
        <div class="card action-card">
            <div>
                {{__('app.game.index')}}
            </div>
            <div class="btn-container">
                <x-primary-button-link href="{{ route('games.create') }}">{{__('button.add')}}</x-primary-button-link>
            </div>
        </div>

        @forelse($games as $game)
            <x-admin-card>
                <div class="game-info-wrapper">
                    @if(!empty($game->getCoverImageUrl()))
                        <img width="160" src="{{ $game->getCoverImageUrl() }}" alt="{{ $game->title }}">
                    @endif
                    <div class="game-info-details">
                        <h3>{{ $game->title }}</h3>
                        <p>{{ $game->comments }}</p>
                        @if(!empty($game->url))
                            <small><a href="{{ $game->info_url }}">{{__('app.game.info')}}</a></small>
                        @endif
                    </div>
                </div>
                <div class="btn-container">
                    <x-secondary-button-link
                        href="{{ route('games.edit', $game) }}">{{__('button.edit')}}</x-secondary-button-link>
                    <x-secondary-button-link href="{{ route('captures.index', $game) }}">{{__('app.capture.name')}}
                    </x-secondary-button-link>
                    <x-danger-button x-data=""
                                     x-on:click.prevent="$dispatch('open-modal', 'confirm-game-deletion-{{$game->slug}}')"
                    >{{ __('button.delete') }}</x-danger-button>
                </div>
                <x-modal name="confirm-game-deletion-{{$game->slug}}" :show="$errors->gameDeletion->isNotEmpty()"
                         focusable>
                    <form method="post" action="{{ route('games.destroy', $game) }}">
                        @csrf
                        @method('delete')

                        <h2>{{ __('Are you sure you want to delete this game?') }}</h2>

                        <div class="btn-container">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('button.cancel') }}
                            </x-secondary-button>

                            <x-danger-button>
                                {{ __('button.delete') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
            </x-admin-card>
        @empty
            <x-admin-card>
                {{__('app.game.empty')}}
            </x-admin-card>
        @endforelse
    </x-admin-card-holder>
</x-admin-layout>
