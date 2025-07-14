<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @livewireStyles
</head>
<body>
    {{-- Bannière globale (optionnelle) --}}
    <x-banner />

    {{-- Menu de navigation --}}
    @livewire('navigation-menu')

    {{-- Titre de page --}}
    @if (isset($header))
        <header>
            <div>
                {{ $header }}
            </div>
        </header>
    @endif

    {{-- Contenu principal --}}
    <main>
        {{ $slot }}
    </main>

    @stack('modals')
    @livewireScripts
</body>
</html>
