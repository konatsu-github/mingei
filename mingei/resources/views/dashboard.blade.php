<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">ダッシュボード</h1>
    </x-slot>

    <section class="bg-white dark:bg-gray-900">
        <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
            <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">今までのライブの平均評価</h2>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-8">
                <img class="w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/office-long-2.png" alt="office content 1">
                <div>
                    <x-advanced-rating />
                </div>

            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
        <div class="items-center py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <x-heading1>コミュニティー</x-heading1>
            <div class="mb-10">
                <x-heading2>なんでも板</x-heading2>
                <x-ita />
            </div>
            <div class="mb-10">
                <x-heading2>相方募集板</x-heading2>
                <x-ita />
            </div>
            <div class="mb-10">
                <x-heading2>ライブ代打探し板</x-heading2>
                <x-ita />
            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
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
    </section>
</x-app-layout>