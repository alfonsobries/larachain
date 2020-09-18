<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (auth()->user() && auth()->user()->dark)
class="dark"
@endif
>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="shortcut icon" href="/favicon.png" type="image/png">

    @livewireStyles

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.2.1/dist/alpine.js" defer></script>

</head>

<body class="bg-gray-100 dark:bg-gray-800">
    @if (session()->has('mainSuccess'))
        <x-alert-success>
            {{ session('mainSuccess')}}
        </x-alert-success>
     @endif
     
    {{ $slot }}

    @livewireScripts

    <script src="{{ mix('/js/app.js') }}"></script>

    @stack('scripts')
</body>

</html>
