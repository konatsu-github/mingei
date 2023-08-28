<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">
            @if(auth()->check() && auth()->user()->id == $profileUser -> id)
            マイプロフィール
            @else
            {{ $profileUsermeta->pinname ?: $profileUsermeta->nickname }}さんのプロフィール
            @endif
        </h1>
    </x-slot>

    <section>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div>

                    <div class="flex">
                        <div class="flex items-center space-x-4 mr-4">
                            <img class="h-8 w-8 rounded-full" src="{!! $profileAvatarUrl !!}" alt="">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-base font-semibold leading-7 text-gray-900">{{ $profileUsermeta->pinname ?: $profileUsermeta->nickname }}</h3>
                                <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">{{ $profileUsermeta->combiname }}</p>
                            </div>
                        </div>
                        @livewire('follow-button', ['videoUserId' => $profileUser->id])
                    </div>



                    <div class="mt-6 border-t border-gray-100">
                        <dl class="divide-y divide-gray-100">
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">総フォロワー数</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ formatNumber($totalFollowersCount) }}</dd>
                            </div>
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

        @auth
        @if(auth()->check() && auth()->user()->id == $profileUser -> id)
        <div x-data="{ isOpen: false }" id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
            <div id="accordion-flush-heading-1">
                <button x-on:click="isOpen = !isOpen" type="button" :class="{ 'text-gray-900': isOpen }" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400" data-accordion-target="#accordion-flush-body-1" aria-expanded="true" aria-controls="accordion-flush-body-1">
                    <span>フォロー中のユーザー</span>
                    <svg :class="{ 'rotate-180': isOpen }" data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </div>
            <div id="accordion-flush-body-1" :class="{ 'hidden': !isOpen }" aria-labelledby="accordion-flush-heading-1">
                <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                    <ul>
                        @foreach ($followedUsers as $followedUser)
                        <li class="mb-4">
                            <a href="{{ route('profile.show', ['id' => $followedUser['user']->id]) }}" class="flex items-center space-x-4 pt-3">
                                <img class="h-8 w-8 rounded-full" src="{!! $followedUser['avatarUrl']; !!}" alt="">
                                <div class="font-medium dark:text-white">
                                    @if ($followedUser['usermeta']['pinname'])
                                    <div>{{ $followedUser['usermeta']['pinname'] }}</div>
                                    @else
                                    <div>{{ $followedUser['usermeta']['nickname'] }}</div>
                                    @endif
                                    @if ($followedUser['usermeta']['combiname'])
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $followedUser['usermeta']['combiname'] }}</div>
                                    @endif
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif
        @endauth
    </section>

    @if(auth()->check() && auth()->user()->id == $profileUser -> id)
    <section class="mt-10">
        <x-alert />
        <div class="pb-4 border-b border-gray-600">
            <h3 class="text-xl font-semibold leading-6 text-gray-800">保存した動画一覧</h3>
        </div>

        <div class="relative mx-auto max-w-7xl">
            <div class="grid max-w-lg gap-12 mx-auto mt-12 lg:grid-cols-3 lg:max-w-none">
                @foreach ($saveVideosItems as $videoItem)
                <x-video-list-item src="{!! $videoItem['thumbnailUrl'] !!}" alt="{{ $videoItem['video']->description }}" publishedDays="{{$videoItem['video'] -> created_at->format('Y/m/d')}}" views="{{ $videoItem['video']->view_count }}" title="{{ $videoItem['video']->title }}" description="{{ $videoItem['video']->description }}" id="{{ $videoItem['video']->id }}" profileLink="{{ route('profile.show', ['id' => $videoItem['video']->user_id]) }}" profileImage="{!! $videoItem['avatarUrl'] !!}" name="{{ $videoItem['usermeta']->pinname ?: $videoItem['usermeta']->nickname }}" combiName="{{ $videoItem['usermeta']->combiname }}" userId="{{ $videoItem['video']->user_id }}" />
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section class="mt-10">
        <x-alert />
        <div class="pb-4 border-b border-gray-600">
            <h3 class="text-xl font-semibold leading-6 text-gray-800">動画一覧</h3>
        </div>

        <div class="relative mx-auto max-w-7xl">
            <div class="grid max-w-lg gap-12 mx-auto mt-12 lg:grid-cols-3 lg:max-w-none">
                @foreach ($videosItems as $videoItem)
                <x-video-list-item src="{!! $videoItem['thumbnailUrl'] !!}" alt="{{ $videoItem['video']->description }}" publishedDays="{{$videoItem['video'] -> created_at->format('Y/m/d')}}" views="{{ $videoItem['video']->view_count }}" title="{{ $videoItem['video']->title }}" description="{{ $videoItem['video']->description }}" id="{{ $videoItem['video']->id }}" profileLink="{{ route('profile.show', ['id' => $videoItem['video']->user_id]) }}" profileImage="{!! $videoItem['avatarUrl'] !!}" name="{{ $videoItem['usermeta']->pinname ?: $videoItem['usermeta']->nickname }}" combiName="{{ $videoItem['usermeta']->combiname }}" userId="{{ $videoItem['video']->user_id }}" />
                @endforeach
            </div>
        </div>
    </section>

</x-app-layout>