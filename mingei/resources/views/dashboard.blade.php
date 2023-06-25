<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">ダッシュボード</h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-content title="ライブ">
                    <div class="mb-4">
                        <x-heading2>前回のライブの平均評価</x-heading2>
                        <x-rating rate='4' num='1' />
                    </div>
                    <div class="mb-4">
                        <x-heading2>今までのライブの平均評価</x-heading2>
                        <x-advanced-rating />
                    </div>
                </x-content>

                <x-content title="コミュニティー">
                    <div class="mb-4">
                        <x-heading2>相方募集板</x-heading2>
                        <x-ita />
                    </div>
                    <div class="mb-4">
                        <x-heading2>コント道具貸し借り板</x-heading2>
                        <x-ita />
                    </div>
                    <div class="mb-4">
                        <x-heading2>ライブ代打探し板</x-heading2>
                        <x-ita />
                    </div>
                    <div class="mb-4">
                        <x-heading2>ネタの種板</x-heading2>
                        <x-ita />
                    </div>
                </x-content>

            </div>
        </div>
    </div>
</x-app-layout>