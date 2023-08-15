<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">プロフィール</h1>
    </x-slot>

    <section>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <div class="flex items-center space-x-4 pt-3">
                        <img class="h-8 w-8 rounded-full" src="{!! $profileAvatarUrl !!}" alt="">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-base font-semibold leading-7 text-gray-900">{{ $profileUsermeta->pinname ?: $profileUsermeta->nickname }}</h3>
                            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">{{ $profileUsermeta->combiname }}</p>
                        </div>
                    </div>

                    <div class="mt-6 border-t border-gray-100">
                        <dl class="divide-y divide-gray-100">
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">総動画数</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ formatNumber($videoCount) }}</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">総いいね数</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ formatNumber($goodRatingCount) }}</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">総再生回数</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ formatNumber($totalViewCount) }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-10">
        <div class="pb-4 border-b border-gray-600">
            <h3 class="text-xl font-semibold leading-6 text-gray-800">動画一覧</h3>
        </div>

        <div class="relative mx-auto max-w-7xl">
            <div class="grid max-w-lg gap-12 mx-auto mt-12 lg:grid-cols-3 lg:max-w-none">
                @foreach ($videosItems as $videoItem)
                <x-video-list-item src="{!! $videoItem['thumbnailUrl'] !!}" alt="{{ $videoItem['video']->description }}" publishedDays="{{$videoItem['video'] -> created_at->format('Y/m/d')}}" views="{{ $videoItem['video']->view_count }}" title="{{ $videoItem['video']->title }}" description="{{ $videoItem['video']->description }}" id="{{ $videoItem['video']->id }}" profileLink="#" profileImage="{!! $videoItem['avatarUrl'] !!}" name="{{ $videoItem['usermeta']->pinname ?: $videoItem['usermeta']->nickname }}" combiName="{{ $videoItem['usermeta']->combiname }}" />
                @endforeach
            </div>
        </div>
    </section>

</x-app-layout>