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
                <a href="{{ route('profile.show', ['id' => $video->user_id]) }}" class="flex mt-6 items-center space-x-4">
                    <img class="h-8 w-8 rounded-full" src="{!! $videoAvatarUrl !!}" alt="">
                    <div class="font-medium dark:text-white">
                        <div>{{ $usermeta->pinname ?: $usermeta->nickname }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $usermeta->combiname }}</div>
                    </div>
                </a>
            </div>

            @livewire('rate-video', ['videoId' => $video->id])

            <div class="flex mt-6">
                <div x-data="{ follow : false, keep : false }" class="flex flex-wrap">
                    @livewire('follow-button', ['videoUserId' => $video->user_id])
                    <button class="flex items-center space-x-1 p-2 bg-white whitespace-nowrap mr-2 outline-none ring-2 ring-gray-300 font-medium rounded-full text-sm text-center">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                            <path d="M727-80q-47.5 0-80.75-33.346Q613-146.693 613-194.331q0-6.669 1.5-16.312T619-228L316-404q-15 17-37 27.5T234-366q-47.5 0-80.75-33.25T120-480q0-47.5 33.25-80.75T234-594q23 0 44 9t38 26l303-174q-3-7.071-4.5-15.911Q613-757.75 613-766q0-47.5 33.25-80.75T727-880q47.5 0 80.75 33.25T841-766q0 47.5-33.25 80.75T727-652q-23.354 0-44.677-7.5T646-684L343-516q2 8 3.5 18.5t1.5 17.741q0 7.242-1.5 15Q345-457 343-449l303 172q15-14 35-22.5t46-8.5q47.5 0 80.75 33.25T841-194q0 47.5-33.25 80.75T727-80Zm.035-632Q750-712 765.5-727.535q15.5-15.535 15.5-38.5T765.465-804.5q-15.535-15.5-38.5-15.5T688.5-804.465q-15.5 15.535-15.5 38.5t15.535 38.465q15.535 15.5 38.5 15.5Zm-493 286Q257-426 272.5-441.535q15.5-15.535 15.5-38.5T272.465-518.5q-15.535-15.5-38.5-15.5T195.5-518.465q-15.5 15.535-15.5 38.5t15.535 38.465q15.535 15.5 38.5 15.5Zm493 286Q750-140 765.5-155.535q15.5-15.535 15.5-38.5T765.465-232.5q-15.535-15.5-38.5-15.5T688.5-232.465q-15.5 15.535-15.5 38.5t15.535 38.465q15.535 15.5 38.5 15.5ZM727-766ZM234-480Zm493 286Z" />
                        </svg>
                        <span>共有</span>
                    </button>
                    @livewire('save-video', ['videoId' => $video->id, 'videoUserId' => $video->user_id])
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
                @foreach ($relatedVideosItems as $videoItem)
                <x-video-list-item src="{!! $videoItem['thumbnailUrl'] !!}" alt="{{ $videoItem['video']->description }}" publishedDays="{{$videoItem['video'] -> created_at->format('Y/m/d')}}" views="{{ $videoItem['video']->view_count }}" title="{{ $videoItem['video']->title }}" description="{{ $videoItem['video']->description }}" id="{{ $videoItem['video']->id }}" profileLink="{{ route('profile.show', ['id' => $videoItem['video']->user_id]) }}" profileImage="{!! $videoItem['avatarUrl'] !!}" name="{{ $videoItem['usermeta']->pinname ?: $videoItem['usermeta']->nickname }}" combiName="{{ $videoItem['usermeta']->combiname }}" />
                @endforeach

            </div>
        </div>


    </section>
</x-app-layout>