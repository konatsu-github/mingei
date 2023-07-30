<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{$video -> title}}</h1>
    </x-slot>

    <section>
        <div class="relative">
            <video controls class="w-full">
                <source src="{!! $videoUrl !!}" type="video/mp4">
            </video>
        </div>
        <div class="mx-auto max-w-7xl py-6 px-6 lg:px-8">
            <div class="flex space-x-1 text-sm text-gray-500">
                <time>{{$video -> created_at->format('Y/m/d')}}</time>
                <span aria-hidden="true">·</span>
                <span>{{ formatNumber($video -> view_count) }} 回視聴</span>
            </div>

            <div>
                <a href="#" class="flex mt-6 items-center space-x-4">
                    <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                    <div class="font-medium dark:text-white">
                        <div>田中レモン</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">有線電車</div>
                    </div>
                </a>
            </div>

            <div x-data="{ funny: 0 }" class="flex items-center mt-8">
                <input x-bind:value="funny" type="hidden" name="funny">

                <button @click="funny == 1 ? funny = 0 : funny = 1" :class="{ 'bg-red-500 text-white': funny == 1 }" class="mr-6 flex items-center outline-none ring-2 ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 text-center">
                    <svg :class="funny == 1 ? 'fill-white' : ''" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                        <path d="M480-261q66 0 121.5-35.5T682-393H278q26 61 81 96.5T480-261ZM302-533l45-45 45 45 36-36-81-81-81 81 36 36Zm267 0 45-45 45 45 36-36-81-81-81 81 36 36ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 340q142.375 0 241.188-98.812Q820-337.625 820-480t-98.812-241.188Q622.375-820 480-820t-241.188 98.812Q140-622.375 140-480t98.812 241.188Q337.625-140 480-140Z" />
                    </svg>
                    面白い ({{ formatNumber($video -> good_count) }})
                </button>
                <button @click="funny == 2 ? funny = 0 : funny = 2" :class="{ 'bg-blue-500 text-white': funny == 2 }" class="flex items-center outline-none ring-2 ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 text-center">
                    <svg :class="funny == 2 ? 'fill-white' : ''" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                        <path d="M626-533q22.5 0 38.25-15.75T680-587q0-22.5-15.75-38.25T626-641q-22.5 0-38.25 15.75T572-587q0 22.5 15.75 38.25T626-533Zm-292 0q22.5 0 38.25-15.75T388-587q0-22.5-15.75-38.25T334-641q-22.5 0-38.25 15.75T280-587q0 22.5 15.75 38.25T334-533Zm146.174 116Q413-417 358.5-379.5T278-280h53q22-42 62.173-65t87.5-23Q528-368 567.5-344.5T630-280h52q-25-63-79.826-100-54.826-37-122-37ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 340q142.375 0 241.188-98.812Q820-337.625 820-480t-98.812-241.188Q622.375-820 480-820t-241.188 98.812Q140-622.375 140-480t98.812 241.188Q337.625-140 480-140Z" />
                    </svg>
                    面白くない ({{ formatNumber($video -> bad_count) }})
                </button>
            </div>

            <div class="flex mt-6">
                <div x-data="{ follow : false, keep : false }" class="flex flex-wrap">
                    <button @click="follow == true ? follow = false : follow = true" :class="{ 'bg-orange-400 text-white': follow }" class="flex items-center space-x-1 p-2 whitespace-nowrap mr-2 outline-none ring-2 ring-gray-300 font-medium rounded-full text-sm text-center">
                        <svg :class="follow ? 'fill-white' : ''" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                            <path d="M730-400v-130H600v-60h130v-130h60v130h130v60H790v130h-60Zm-370-81q-66 0-108-42t-42-108q0-66 42-108t108-42q66 0 108 42t42 108q0 66-42 108t-108 42ZM40-160v-94q0-35 17.5-63.5T108-360q75-33 133.338-46.5 58.339-13.5 118.5-13.5Q420-420 478-406.5 536-393 611-360q33 15 51 43t18 63v94H40Zm60-60h520v-34q0-16-9-30.5T587-306q-71-33-120-43.5T360-360q-58 0-107.5 10.5T132-306q-15 7-23.5 21.5T100-254v34Zm260-321q39 0 64.5-25.5T450-631q0-39-25.5-64.5T360-721q-39 0-64.5 25.5T270-631q0 39 25.5 64.5T360-541Zm0-90Zm0 411Z" />
                        </svg>
                        <span x-text="follow ? 'フォロー中' : 'フォロー'"></span>
                    </button>
                    <button class="flex items-center space-x-1 p-2 bg-white whitespace-nowrap mr-2 outline-none ring-2 ring-gray-300 font-medium rounded-full text-sm text-center">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                            <path d="M727-80q-47.5 0-80.75-33.346Q613-146.693 613-194.331q0-6.669 1.5-16.312T619-228L316-404q-15 17-37 27.5T234-366q-47.5 0-80.75-33.25T120-480q0-47.5 33.25-80.75T234-594q23 0 44 9t38 26l303-174q-3-7.071-4.5-15.911Q613-757.75 613-766q0-47.5 33.25-80.75T727-880q47.5 0 80.75 33.25T841-766q0 47.5-33.25 80.75T727-652q-23.354 0-44.677-7.5T646-684L343-516q2 8 3.5 18.5t1.5 17.741q0 7.242-1.5 15Q345-457 343-449l303 172q15-14 35-22.5t46-8.5q47.5 0 80.75 33.25T841-194q0 47.5-33.25 80.75T727-80Zm.035-632Q750-712 765.5-727.535q15.5-15.535 15.5-38.5T765.465-804.5q-15.535-15.5-38.5-15.5T688.5-804.465q-15.5 15.535-15.5 38.5t15.535 38.465q15.535 15.5 38.5 15.5Zm-493 286Q257-426 272.5-441.535q15.5-15.535 15.5-38.5T272.465-518.5q-15.535-15.5-38.5-15.5T195.5-518.465q-15.5 15.535-15.5 38.5t15.535 38.465q15.535 15.5 38.5 15.5Zm493 286Q750-140 765.5-155.535q15.5-15.535 15.5-38.5T765.465-232.5q-15.535-15.5-38.5-15.5T688.5-232.465q-15.5 15.535-15.5 38.5t15.535 38.465q15.535 15.5 38.5 15.5ZM727-766ZM234-480Zm493 286Z" />
                        </svg>
                        <span>共有</span>
                    </button>
                    <button @click="keep == true ? keep = false : keep = true" :class="{ 'bg-orange-400 text-white': keep }" class="flex items-center space-x-1 p-2 whitespace-nowrap mr-2 outline-none ring-2 ring-gray-300 font-medium rounded-full text-sm text-center">
                        <svg :class="keep ? 'fill-white' : ''" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M19 19H5V5h7V3H5C3.89 3 3 3.89 3 5v14c0 1.1.89 2 2 2h14c1.11 0 2-.9 2-2v-7h-2v7zm2-10h-7V3l9 9zm-9 2V9h-2v4H8l4 4 4-4h-3z" />
                        </svg>
                        <span x-text="keep ? '保存済' : '保存'"></span>
                    </button>
                    <button class="flex items-center space-x-1 p-2 bg-white whitespace-nowrap mr-2 outline-none ring-2 ring-gray-300 font-medium rounded-full text-sm text-center">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                            <path d="M200-120v-680h343l19 86h238v370H544l-18.933-85H260v309h-60Zm300-452Zm95 168h145v-250H511l-19-86H260v251h316l19 85Z" />
                        </svg>
                        <span>報告</span>
                    </button>
                </div>
            </div>

            <div class="mt-6">
                <p>{{$video -> description}}</p>
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