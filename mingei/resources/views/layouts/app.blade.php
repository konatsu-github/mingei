<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    @if( Request::routeIs('watch'))
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
    @endif
    @livewireStyles
</head>

<body class="font-sans antialiased">

    <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-100">
  <body class="h-full">
  ```
-->
    <div class="min-h-full pt-16">
        @include('layouts.navigation')

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        <main>
            @php
            $currentRoute = request()->route()->getName();
            @endphp
            @if($currentRoute === 'watch')
            <div class="mx-auto max-w-7xl pb-6">
                @else
                <div class="mx-auto max-w-7xl py-6 px-6 lg:px-8">
                    @endif
                    {{ $slot }}
                </div>
        </main>
    </div>

    <footer class="bg-white rounded-lg shadow dark:bg-gray-800">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 みんなの芸人動画™. All Rights Reserved.
            </span>
            <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6 ">みんなの芸人動画について</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6">プライバシーポリシー</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6">利用規約</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">お問合せ</a>
                </li>
            </ul>
        </div>
    </footer>

    @livewireScripts
</body>

</html>