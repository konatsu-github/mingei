<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-MB8C3NQN');
    </script>
    <!-- End Google Tag Manager -->
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
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MB8C3NQN" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
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

    <footer class="bg-white rounded-lg shadow ">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-500 sm:text-center">© 2023 みんなのげいにんどうが™. All Rights Reserved.
            </span>
            <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 sm:mt-0">
                <li>
                    <a href="{{route('about')}}" class="mr-4 hover:underline md:mr-6 ">みんなのげいにんどうがについて</a>
                </li>
                <li>
                    <a href="{{route('privacy')}}" class="mr-4 hover:underline md:mr-6">プライバシーポリシー</a>
                </li>
                <li>
                    <a href="{{route('terms')}}" class="mr-4 hover:underline md:mr-6">利用規約</a>
                </li>
                <li>
                    <a href="https://twitter.com/yurii_geinin" target="_blank" rel="noopener" class="hover:underline">X（旧Twitter）</a>
                </li>
            </ul>
        </div>
    </footer>

    @livewireScripts
</body>

</html>