<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>

<body style="height: 100%;">
    <div class="app-admin">
        <div class="admin-wrapper">
            {{ $slot }}
        </div>
    </div>
</body>

</html>