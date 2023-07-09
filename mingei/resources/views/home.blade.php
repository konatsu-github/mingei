<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">ホーム</h1>
    </x-slot>

    <section>
        <div class="pb-4 border-b border-gray-600">
            <h3 class="text-xl font-semibold leading-6 text-gray-800">みんなの動画</h3>
        </div>

        <div class="relative mx-auto max-w-7xl">
            <div class="grid max-w-lg gap-12 mx-auto mt-12 lg:grid-cols-3 lg:max-w-none">

                <div class="flex flex-col mb-12 overflow-hidden">
                    <div class="flex-shrink-0">
                        <video x-ref="videoPlayer" controls poster="/images/movieThumb/sample.jpg">
                            <source src="/movies/common/sample.mp4" type="video/mp4">
                            ネタ動画
                        </video>
                    </div>
                    <div class="flex flex-col justify-between flex-1">
                        <div class="flex-1">
                            <div class="flex pt-6 space-x-1 text-sm text-gray-500">
                                <time datetime="2020-03-10">2020年03月10日</time>
                                <span aria-hidden="true"> · </span>
                                <span>1,000回視聴</span>
                            </div>
                            <h3 class="text-2xl font-semibold leading-none tracking-tighter text-neutral-600">コント：お父さんの家</h3>
                            <p class="text-lg font-normal text-gray-500">コントお父さんの家です</p>
                            <a href="" class="flex items-center space-x-4">
                                <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                <div class="font-medium dark:text-white">
                                    <div>田中レモン</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">コンビ名：有線電車</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </section>
</x-app-layout>