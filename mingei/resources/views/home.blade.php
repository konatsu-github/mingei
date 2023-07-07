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
</x-app-layout>