<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- tailwind css -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    <div class="relative flex items-top justify-center min-h-screen bg-slate-100 dark:bg-Slate-900 sm:items-center py-4 sm:pt-0">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </div>
            <p class="text-center">みんなのための推しお笑い芸人活動アプリ</p>

            <div class="mt-8 bg-white dark:bg-orange-400 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold">お客さん</div>
                        </div>

                        <div class="ml-4">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                あなたの推しているお笑い芸人のライブ告知やファンへのつぶやきを通知で受け取ることができます。投票機能もありますので、是非あなたの推し芸人に元気を与えて売れさせてあげてください！
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold">お笑い芸人</div>
                        </div>

                        <div class="ml-4">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                あなたの活動をファンに向けて発信してください。また、他のお笑い芸人同士のコミュニティーをさらに広げるための機能をそろえております。あなたが売れるまでの間、うまく活用してください。
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mt-8 p-6 flex">
                @auth
                <a href="{{ route('dashboard') }}" class="px-5 py-4 font-semibold flex-1 mr-6 text-base font-medium text-center text-white transition duration-500 ease-in-out transform bg-orange-400 lg:px-10 rounded-xl hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-300">ダッシュボード</a>
                @else
                <a href="{{ route('login') }}" class="px-5 py-4 font-semibold flex-1 mr-6 text-base font-medium text-center text-white transition duration-500 ease-in-out transform bg-orange-400 lg:px-10 rounded-xl hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-300">ログイン</a>
                <a href="{{ route('register') }}" class="px-5 py-4 font-semibold flex-1 ml-6 text-base font-medium text-center text-white transition duration-500 ease-in-out transform bg-orange-400 lg:px-10 rounded-xl hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-300">会員登録</a>
                @endauth
            </div>

        </div>
    </div>
</body>

</html>