<!DOCTYPE html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=bungee-inline:400&display=swap" rel="stylesheet" />

    @vite('resources/js/app.js')
    @inertiaHead
</head>

<body class="h-full">@inertia</body>

</html>
