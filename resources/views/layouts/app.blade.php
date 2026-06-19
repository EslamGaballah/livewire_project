<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        {{-- <div class="container-fluid bg-light"> --}}

            @include('layouts.navigation')

            @isset($header)
                <div class="bg-white shadow-sm border-bottom mb-4">
                    <div class="container py-4">
                        {{ $header }}
                    </div>
                </div>
            @endisset

        {{-- </div> --}}
        <!-- Page Content -->
        <main class="py-4">
            <div class="container">

                @isset($slot)
                    {{-- slot used to view content when we use route directly with out controller --}}
                    {{ $slot }}
                @else
                    @yield('content')
                @endisset
                
            </div>
        </main>

            @livewireScripts
    </body>
</html>
