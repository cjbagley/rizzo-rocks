<x-admin-layout :header="$header??''">

    <x-admin-card-holder>
        <div class="card action-card">
            <div>
                Add, edit and delete game captures
            </div>
            <div class="btn-container">
                <x-primary-button-link href="{{ route('captures.create', $game) }}">Add</x-primary-button-link>
            </div>
        </div>

        @forelse($game->captures as $capture)
        <x-admin-card>
            <div class="game-info-wrapper">
                @if($capture->type == 'video')
                <img width="160" src="{{ $capture->url }}" alt="{{ $capture->title }}">
                @else
                <video width="160" controls>
                    Your browser does not support video :(
                    <source src="{{ $capture->href }}" type="video/webm" />
                </video>
                @endif
                <div class="game-info-details">
                    <h3>{{ $capture->title }}</h3>
                    <div><strong>Type: </strong>{{ $capture->type }}</div>
                    <p>{{ $capture->comments }}</p>
                </div>
            </div>
            <div class="btn-container">
                <x-secondary-button-link href="{{ route('captures.edit', ['game' => $game, 'capture' => $capture]) }}">Edit</x-secondary-button-link>
                <x-secondary-button-link href="{{ route('captures.index', ['game' => $game, 'capture' => $capture]) }}">Captures</x-secondary-button-link>
                <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-deletion-{{$capture->id}}')">{{ __('Delete') }}</x-danger-button>
            </div>
            <x-modal name="confirm-deletion-{{$capture->id}}" :show="$errors->gameDeletion->isNotEmpty()" focusable>
                <form method="post" action="{{ route('captures.destroy', ['game' => $game, 'capture' => $capture]) }}">
                    @csrf
                    @method('delete')

                    <h2>
                        {{ __('Are you sure you want to delete this game?') }}
                    </h2>

                    <div class="btn-container">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-danger-button>
                            {{ __('Delete') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
        </x-admin-card>
        @empty
        <x-admin-card>
            No captures added yet!
        </x-admin-card>
        @endforelse
    </x-admin-card-holder>
</x-admin-layout>
