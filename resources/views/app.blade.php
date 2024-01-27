<!DOCTYPE html>
<html style="height: 100%;" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=bungee-inline:400&display=swap" rel="stylesheet" />

    @vite('resources/js/app.js')
    @inertiaHead
</head>

<body style="height: 100%;">@inertia</body>

</html>