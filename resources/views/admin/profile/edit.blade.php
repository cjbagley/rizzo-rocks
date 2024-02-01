<x-admin-layout :header="$header??''">
    <x-admin-card-holder>
        <x-admin-card>
            @include('admin.profile.partials.update-profile-information-form')
        </x-admin-card>
        <x-admin-card>
            @include('admin.profile.partials.update-password-form')
        </x-admin-card>
        <x-admin-card>
            @include('admin.profile.partials.delete-user-form')
        </x-admin-card>
    </x-admin-card-holder>
</x-admin-layout>