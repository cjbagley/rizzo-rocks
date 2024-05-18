<x-admin-layout :header="$header?? __('app.tag.create')">
    <x-admin-card-holder>
        <x-admin-card>
            @if (!empty(session('tag')))
                <p class="mt-2 font-medium text-sm text-green-600">
                    {{ __("{session('tag')->tag} Added") }}
                </p>
            @endif
            @include('admin.tags.partials.tag-form')
        </x-admin-card>
    </x-admin-card-holder>
</x-admin-layout>
