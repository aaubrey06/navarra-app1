<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('rise.png') }}" type="image/png">
    <link rel="icon" href="{{ asset('rise.png') }}" sizes="16x16" type="image/png">
    <link rel="icon" href="{{ asset('rise.png') }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ asset('rise.png') }}" sizes="96x96" type="image/png">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <livewire:layout.navigation />

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        {{-- <button id="notificationButton">
            Notifications (<span id="notificationCount">{{ auth()->user()->unreadNotifications->count() }}</span>)
        </button>

        <div id="notificationDropdown" style="display:none;">
            <ul id="notificationList">
                @foreach (auth()->user()->unreadNotifications as $notification)
                    <li>{{ $notification->data['message'] }}</li>
                @endforeach
            </ul>
        </div> --}}

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
