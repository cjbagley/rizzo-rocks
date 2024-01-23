<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Captures') }}
            </h2>
            <x-primary-button-link href="{{ route('captures.create' , $game) }}">Add Capture</x-primary-button-link>
        </div>
    </x-slot>

    <x-admin-card-holder>
        @forelse($game->captures as $capture)
        <x-admin-card>
            <div class="flex flex-col items-start md:flex-row gap-5">
                <img width="160" class="max-md:mx-auto" src="{{ $capture->url }}" alt="{{ $capture->title }}">
                <div class="flex flex-col justify-between max-md:pl-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $capture->title }}</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $capture->comments }}</p>
                </div>
            </div>
            <div class="flex justify-end space-x-5">
                <x-secondary-button-link href="{{ route('captures.edit', ['game' => $game, 'capture' => $capture]) }}">Edit</x-secondary-button-link>
                <x-secondary-button-link href="{{ route('captures.index', ['game' => $game, 'capture' => $capture]) }}">Captures</x-secondary-button-link>
                <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-deletion-{{$capture->id}}')">{{ __('Delete') }}</x-danger-button>
            </div>
            <x-modal name="confirm-deletion-{{$capture->id}}" :show="$errors->gameDeletion->isNotEmpty()" focusable>
                <form method="post" action="{{ route('captures.destroy', ['game' => $game, 'capture' => $capture]) }}" class="p-6">
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
            No captures added yet!
        </x-admin-card>
        @endforelse
    </x-admin-card-holder>
</x-admin-layout>
