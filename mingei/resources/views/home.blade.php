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
    <div class="relative flex items-top justify-center min-h-screen bg-orange-50 sm:items-center py-4 sm:pt-0">

        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </div>

            <div class="mt-8 bg-white dark:bg-orange-400 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold">あなたの推し芸人をフォロー</div>
                        </div>

                        <div class="ml-4">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                あなたの推し芸人をフォローして最新のネタ動画情報をいち早くキャッチできます！
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold">全国どこからでもネタ動画を無料で視聴できます！</div>
                        </div>

                        <div class="ml-4">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                全国どこからでもお笑い芸人のネタ動画を視聴できます。まだ未公開のここでしか見れないネタ動画を見れるかも！
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold">お笑い芸人</div>
                        </div>

                        <div class="ml-4">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                ネタ動画を投稿してファンを増やそう！
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mt-8 mb-8 py-6 flex">
                @auth
                <a href="{{ route('dashboard') }}" class="px-5 py-4 font-semibold flex-1 mr-6 text-base font-medium text-center text-white transition duration-500 ease-in-out transform bg-orange-400 lg:px-10 rounded-xl hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-300">ダッシュボード</a>
                @else
                <a href="{{ route('login') }}" class="px-5 py-4 font-semibold flex-1 mr-6 text-base font-medium text-center text-white transition duration-500 ease-in-out transform bg-orange-400 lg:px-10 rounded-xl hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-300">ログイン</a>
                <a href="{{ route('register') }}" class="px-5 py-4 font-semibold flex-1 ml-6 text-base font-medium text-center text-white transition duration-500 ease-in-out transform bg-orange-400 lg:px-10 rounded-xl hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-300">会員登録</a>
                @endauth
            </div>

            <section>
                <div class="pb-4 border-b border-gray-600">
                    <h3 class="text-xl font-semibold leading-6 text-gray-800">みんなのネタ動画</h3>
                </div>

                <div class="relative mx-auto max-w-7xl">
                    <div class="grid max-w-lg gap-12 mx-auto mt-12 lg:grid-cols-3 lg:max-w-none">
                        <div class="flex flex-col mb-12 overflow-hidden cursor-pointer">
                            <div class="flex-shrink-0">
                                <video controls poster="/images/movieThumb/sample.jpg">
                                    <source src="/movies/common/sample.mp4" type="video/mp4">
                                    ネタ動画
                                </video>
                            </div>
                            <div class="flex flex-col justify-between flex-1">
                                <div class="flex-1">
                                    <div class="flex pt-6 space-x-1 text-sm text-gray-500">
                                        <time datetime="2020-03-10"> Mar 10, 2020 </time>
                                        <span aria-hidden="true"> · </span>
                                        <span> 4 min read </span>
                                    </div>
                                    <h3 class="text-2xl font-semibold leading-none tracking-tighter text-neutral-600">Typography on app.</h3>
                                    <p class="text-lg font-normal text-gray-500">Filling text so you can see how it looks like with text. Did I said text?</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- <section class="bg-white dark:bg-gray-900">
                <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
                    <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">今月の注目芸人</h2>
                        <p class="mb-4">今月の注目芸人はこの2組。新たな風を巻き起こす。バトル座で3連勝中で勢い満点！</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <img class="w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/office-long-2.png" alt="office content 1">
                        <img class="mt-4 w-full lg:mt-10 rounded-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/office-long-1.png" alt="office content 2">
                    </div>
                </div>
            </section> -->

        </div>
    </div>

</body>

</html>