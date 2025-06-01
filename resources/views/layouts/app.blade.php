<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Restaurant Management') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <nav class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-xl font-bold">Restaurant</a>
                    </div>
                    @auth


                    @if(!(auth()->user()->isAdmin()))
                    <a href="{{ route('my_record') }}" class="ml-4 flex items-center text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100">My Record</a>
                        @endif
                        @if(auth()->user()->isAdmin())
                        <a href="{{ route('meals') }}" class="ml-4 flex items-center text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100">Meals</a>
                            <a href="{{ route('inventory') }}" class="ml-4 flex items-center text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100">Inventory</a>
                            <a href="{{ route('users') }}" class="ml-4 flex items-center text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100">Users</a>
                            <a href="{{ route('categories') }}" class="ml-4 flex items-center text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100">Categories</a>
                            <a href="{{ route('orders') }}" class="ml-4 flex items-center text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100">Orders</a>
                            <a href="{{ route('reservations') }}" class="ml-4 flex items-center text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100">Reservations</a>
                            <a href="{{ route('report') }}" class="ml-4 flex items-center text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100">Report</a>

                        @endif
                    @endauth
                </div>
                <div class="flex items-center">
                    @auth
                        <span class="mr-4">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-600 dark:text-red-400">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="mr-4">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        {{ $slot }}
    </main>

@livewireScripts

</body>
</html>
