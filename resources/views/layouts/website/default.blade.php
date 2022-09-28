<!doctype html>
<html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Rifa Aqui') }}</title>
    <link rel="icon" type="png" href="{{ Vite::asset('resources/img/website/favicon.png') }}" />

    <!-- CSS -->
    @vite('resources/css/website/global.scss')
    <link href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" rel="stylesheet" />

    {!! $stylesheets ?? '' !!}

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
</head>

<body>
    {{ $slot }}

    @vite('resources/js/website/global.js')
    {!! $javascripts ?? '' !!}
</body>

</html>
