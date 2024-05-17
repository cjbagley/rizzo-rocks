<x-admin-layout :header="$header?? __('app.game.create')">
    <x-admin-card-holder>
        <x-admin-card>
            @if (!empty(session('game')))
                <p class="mt-2 font-medium text-sm text-green-600">
                    {{ __("{session('game')->title} Added") }}
                </p>
            @endif
            @include('admin.games.partials.game-form')
        </x-admin-card>
    </x-admin-card-holder>
</x-admin-layout>
