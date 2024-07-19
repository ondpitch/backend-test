<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8" />

        <meta name="application-name" content="{{ config('app.name') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ config('app.name') }}</title>

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        @filamentStyles
        @vite('resources/css/app.css')
    </head>

    <body class="antialiased">
        <div class="flex w-full">
            <div class="w-[400px]">
                <x-navs.sidebar />
            </div>
            <div class="flex-1">
                {{ $slot }}
            </div>
        </div>

        @livewire('notifications')

        @filamentScripts
        @vite('resources/js/app.js')
    </body>

</html>
