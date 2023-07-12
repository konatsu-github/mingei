<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">ここにタイトル</h1>
    </x-slot>

    <section>
        <div class="relative">
            <video controls class="w-full">
                <source src="/movies/common/sample.mp4" type="video/mp4">
                ここに動画の説明
            </video>
        </div>
        <div class="mx-auto max-w-7xl py-6 px-6 lg:px-8">
            <div class="flex space-x-1 text-sm text-gray-500">
                <time>2023/03/10</time>
                <span aria-hidden="true">·</span>
                <span>2,000 回視聴</span>
            </div>

            <div>
                <a href="#" class="flex pt-6 items-center space-x-4">
                    <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                    <div class="font-medium dark:text-white">
                        <div>田中レモン</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">有線電車</div>
                    </div>
                </a>
            </div>

            <div class="flex overflow-x-auto">
                <div class="flex">
                    <button class="flex items-center space-x-1 p-2 bg-white whitespace-nowrap mr-1">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12c0 2.4 1.2 4.5 3.03 5.79-.08.57-.31 1.1-.67 1.54l-.11.13-.05.06C4.85 20.55 8.14 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm-6 9c0-2.76 2.24-5 5-5s5 2.24 5 5-2.24 5-5 5-5-2.24-5-5zm3-5h4v2H9V6zm0 4h4v6H9v-6z" />
                        </svg>
                        <span>フォロー</span>
                    </button>
                    <button class="flex items-center space-x-1 p-2 bg-white whitespace-nowrap mr-1">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M5 12h5.5l-2-2H4V6h4l2-2H2v16h5v-4.5l2 2V12H5zm15-2h-4.5l-2-2H22V2h-5v4.5l-2-2V10H19v2z" />
                        </svg>
                        <span>グッド</span>
                    </button>
                    <button class="flex items-center space-x-1 p-2 bg-white whitespace-nowrap mr-1">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M9 16.17l-4.17 4.17L3 19l4.17-4.17L3 10.67 4.83 9 9 13.17 13.17 9 15 10.83 10.83 15 15 19.17 13.17 21 9 16.83 4.83 21 3 19.17 7.17 15 3 10.83 4.83 9 9 13.17z" />
                        </svg>
                        <span>共有</span>
                    </button>
                    <button class="flex items-center space-x-1 p-2 bg-white whitespace-nowrap mr-1">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M19 19H5V5h7V3H5C3.89 3 3 3.89 3 5v14c0 1.1.89 2 2 2h14c1.11 0 2-.9 2-2v-7h-2v7zm2-10h-7V3l9 9zm-9 2V9h-2v4H8l4 4 4-4h-3z" />
                        </svg>
                        <span>保存</span>
                    </button>
                    <button class="flex items-center space-x-1 p-2 bg-white whitespace-nowrap mr-1">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 4v3h5.5v12h3V7H19V4z" />
                        </svg>
                        <span>報告</span>
                    </button>
                </div>
            </div>




        </div>
    </section>

    <section class="mx-auto max-w-7xl py-6 px-6 lg:px-8">
        <div class="pb-4 border-b border-gray-600">
            <h3 class="text-xl font-semibold leading-6 text-gray-800">関連動画</h3>
        </div>

        <div class="relative mx-auto max-w-7xl">
            <div class="grid max-w-lg gap-12 mx-auto mt-12 lg:grid-cols-3 lg:max-w-none">

                <x-video-list-item src="/images/movieThumb/sample.jpg" alt="ネタ動画" publishedDays="3日前" views="2000" title="コント：お父さんの家" description="コントお父さんの家です" id="eagre32" profileLink="#" profileImage="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" name="田中レモン" combiName="有線電車" />

            </div>
        </div>


    </section>
</x-app-layout>