<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lookup') }}
        </h2>
    </x-slot>

    <x-admin-card-holder>
        <x-admin-card>
            @include('admin.lookup.partials.lookup-form')
        </x-admin-card>

        <x-admin-card>
            @include('admin.lookup.partials.lookup-result')
        </x-admin-card>
    </x-admin-card-holder>
</x-admin-layout>
