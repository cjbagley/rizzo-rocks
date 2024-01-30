<x-admin-layout :header="$header??''">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lookup') }}
        </h2>
    </x-slot>

    <x-admin-card-holder>
        <x-admin-card>
            @include('admin.lookup.partials.lookup-form')
        </x-admin-card>

        @if(session('data') !== null)
        @include('admin.lookup.partials.lookup-result')
        @endif

        @if(session('api_error'))
        <x-admin-card>
            <p>{{ session('api_error') }}</p>
        </x-admin-card>
        @endif
    </x-admin-card-holder>
</x-admin-layout>