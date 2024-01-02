<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-admin-card-holder>
        <x-admin-card>
            {{ __("You're logged in!") }}
        </x-admin-card>
    </x-admin-card-holder>
</x-admin-layout>
