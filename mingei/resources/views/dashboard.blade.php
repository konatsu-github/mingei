<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">ダッシュボード</h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 mb-4">
                    <h2 class="text-xl font-bold tracking-tight text-gray-900 mb-4">ライブ</h2>
                    <div class="mb-4">
                        <h3>前回のライブの平均評価</h3>
                        <x-rating rate='4' num='1' />
                    </div>
                    <div class="mb-4">
                        <h3>今までのライブの平均評価</h3>
                        <x-rating rate='3.5' num='15' />
                    </div>
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-xl font-bold tracking-tight text-gray-900 mb-4">ライブ</h2>
                    <div class="mb-4">
                        <h3>前回のライブの平均評価</h3>
                        <x-rating rate='4' num='1' />
                    </div>
                    <div class="mb-4">
                        <h3>今までのライブの平均評価</h3>
                        <x-rating rate='3.5' num='15' />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>