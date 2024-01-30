<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/js/admin.js'])
</head>

<body>
    <div class="app-admin">
        @include('components.navigation')
        <div class="main-wrapper background">
            @if ($attributes->get('header'))
            <header class="card">
                {{ $attributes->get('header') }}
            </header>
            @endif

            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>