<x-admin-layout :header="$header??''">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Capture') }}
        </h2>
    </x-slot>

    <x-admin-card-holder>
        <x-admin-card>
            @if (!empty(session('capture')))
            <p class="mt-2 font-medium text-sm text-green-600">
                {{ __("{session('capture')->title} Added") }}
            </p>
            @endif
            @include('admin.captures.partials.capture-form')
        </x-admin-card>
    </x-admin-card-holder>
</x-admin-layout>