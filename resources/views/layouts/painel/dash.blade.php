<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite('resources/css/painel/global.scss')
        {!! $stylesheets ?? '' !!}
    </head>

    <body class="mode-light">
        <div class="wrapper d-flex min-vh-100">
            <x-painel.leftbar />

            <div class="w-100">
                <x-painel.header />

                <div class="wrapper d-flex">
                    <div class="main w-100 d-flex flex-column">
                        {{ $slot }}

                        <x-painel.footer />
                    </div>

                    <x-painel.rightbar />
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        @vite('resources/js/painel/global.js')
        {!! $javascripts ?? '' !!}
    </body>
</html>
