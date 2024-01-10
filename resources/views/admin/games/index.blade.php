<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Games') }}
            </h2>
            <x-primary-button>Test</x-primary-button>
        </div>
    </x-slot>

    <x-admin-card-holder>
        <x-admin-card>
            @if($games->isEmpty())
            No games added yet!
            @else
            @endif
        </x-admin-card>
    </x-admin-card-holder>
</x-admin-layout>
