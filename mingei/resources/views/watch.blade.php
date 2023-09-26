<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{$video -> title}}</h1>
    </x-slot>

    <x-alert />
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
                    <div class="font-medium">
                        <div>{{ $usermeta->pinname ?: $usermeta->nickname }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $usermeta->combiname }}</div>
                    </div>
                </a>
            </div>

            @livewire('rate-video', ['videoId' => $video->id])

            <div class="flex mt-6">
                <div x-data="{ follow : false, keep : false, showShareButton:false }" class="flex flex-nowrap overflow-auto">
                    @livewire('follow-button', ['videoUserId' => $video->user_id])
                    @livewire('save-video', ['videoId' => $video->id, 'videoUserId' => $video->user_id])

                    <div x-on:click.away="showShareButton = false" class="relative">
                        <!-- 共有ボタンのトグルボタン -->
                        <button @click="showShareButton = !showShareButton" class="flex items-center space-x-1 p-2 bg-white whitespace-nowrap mr-2 outline-none ring-2 ring-gray-300 font-medium rounded-full text-xs text-center">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                                <path d="M727-80q-47.5 0-80.75-33.346Q613-146.693 613-194.331q0-6.669 1.5-16.312T619-228L316-404q-15 17-37 27.5T234-366q-47.5 0-80.75-33.25T120-480q0-47.5 33.25-80.75T234-594q23 0 44 9t38 26l303-174q-3-7.071-4.5-15.911Q613-757.75 613-766q0-47.5 33.25-80.75T727-880q47.5 0 80.75 33.25T841-766q0 47.5-33.25 80.75T727-652q-23.354 0-44.677-7.5T646-684L343-516q2 8 3.5 18.5t1.5 17.741q0 7.242-1.5 15Q345-457 343-449l303 172q15-14 35-22.5t46-8.5q47.5 0 80.75 33.25T841-194q0 47.5-33.25 80.75T727-80Zm.035-632Q750-712 765.5-727.535q15.5-15.535 15.5-38.5T765.465-804.5q-15.535-15.5-38.5-15.5T688.5-804.465q-15.5 15.535-15.5 38.5t15.535 38.465q15.535 15.5 38.5 15.5Zm-493 286Q257-426 272.5-441.535q15.5-15.535 15.5-38.5T272.465-518.5q-15.535-15.5-38.5-15.5T195.5-518.465q-15.5 15.535-15.5 38.5t15.535 38.465q15.535 15.5 38.5 15.5Zm493 286Q750-140 765.5-155.535q15.5-15.535 15.5-38.5T765.465-232.5q-15.535-15.5-38.5-15.5T688.5-232.465q-15.5 15.535-15.5 38.5t15.535 38.465q15.535 15.5 38.5 15.5ZM727-766ZM234-480Zm493 286Z" />
                            </svg>
                            <span>共有</span>
                        </button>

                        <!-- 共有ボタン -->
                        <div x-show="showShareButton" class="absolute left-0 top-0 mt-8 bg-white border border-gray-300 rounded-lg shadow-lg flex">
                            <!-- 共有ボタンの内容をここに配置 -->
                            <a href="https://twitter.com/share?url={{ route('watch', ['videoId' => intval($video->id)]) }}" rel="nofollow noopener" target="_blank" class="p-2 text-gray-600 hover:bg-gray-100 w-full text-left">
                                <svg viewBox="0 0 1800 1800" xmlns="http://www.w3.org/2000/svg" y="0px" width="35" height="35">
                                    <rect height="100%" width="100%" />
                                    <path d="m1014.2 805.8 446.7-519.3h-105.9l-387.9 450.9-309.8-450.9h-357.3l468.5 681.8-468.5 544.6h105.9l409.6-476.2 327.2 476.2h357.3zm-145 168.5-47.5-67.9-377.7-540.2h162.6l304.8 436 47.5 67.9 396.2 566.7h-162.6z" fill="#fff" />
                                </svg>
                            </a>
                            <a href="http://line.me/R/msg/text/?{{ route('watch', ['videoId' => intval($video->id)]) }}" rel="nofollow noopener" target="_blank" class="p-2 text-gray-600 hover:bg-gray-100 w-full text-left">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="35" height="35" viewBox="0,0,256,256">
                                    <g transform="translate(-39.68,-39.68) scale(1.31,1.31)">
                                        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                            <g transform="scale(5.33333,5.33333)">
                                                <path d="M12.5,42h23c3.59,0 6.5,-2.91 6.5,-6.5v-23c0,-3.59 -2.91,-6.5 -6.5,-6.5h-23c-3.59,0 -6.5,2.91 -6.5,6.5v23c0,3.59 2.91,6.5 6.5,6.5z" fill="#00c300"></path>
                                                <path d="M37.113,22.417c0,-5.865 -5.88,-10.637 -13.107,-10.637c-7.227,0 -13.108,4.772 -13.108,10.637c0,5.258 4.663,9.662 10.962,10.495c0.427,0.092 1.008,0.282 1.155,0.646c0.132,0.331 0.086,0.85 0.042,1.185c0,0 -0.153,0.925 -0.187,1.122c-0.057,0.331 -0.263,1.296 1.135,0.707c1.399,-0.589 7.548,-4.445 10.298,-7.611h-0.001c1.901,-2.082 2.811,-4.197 2.811,-6.544zM18.875,25.907h-2.604c-0.379,0 -0.687,-0.308 -0.687,-0.688v-5.209c0,-0.379 0.308,-0.687 0.687,-0.687c0.379,0 0.687,0.308 0.687,0.687v4.521h1.917c0.379,0 0.687,0.308 0.687,0.687c0,0.38 -0.308,0.689 -0.687,0.689zM21.568,25.219c0,0.379 -0.308,0.688 -0.687,0.688c-0.379,0 -0.687,-0.308 -0.687,-0.688v-5.209c0,-0.379 0.308,-0.687 0.687,-0.687c0.379,0 0.687,0.308 0.687,0.687zM27.838,25.219c0,0.297 -0.188,0.559 -0.47,0.652c-0.071,0.024 -0.145,0.036 -0.218,0.036c-0.215,0 -0.42,-0.103 -0.549,-0.275l-2.669,-3.635v3.222c0,0.379 -0.308,0.688 -0.688,0.688c-0.379,0 -0.688,-0.308 -0.688,-0.688v-5.209c0,-0.296 0.189,-0.558 0.47,-0.652c0.071,-0.024 0.144,-0.035 0.218,-0.035c0.214,0 0.42,0.103 0.549,0.275l2.67,3.635v-3.223c0,-0.379 0.309,-0.687 0.688,-0.687c0.379,0 0.687,0.308 0.687,0.687zM32.052,21.927c0.379,0 0.688,0.308 0.688,0.688c0,0.379 -0.308,0.687 -0.688,0.687h-1.917v1.23h1.917c0.379,0 0.688,0.308 0.688,0.687c0,0.379 -0.309,0.688 -0.688,0.688h-2.604c-0.378,0 -0.687,-0.308 -0.687,-0.688v-2.603c0,-0.001 0,-0.001 0,-0.001v-0.001v-2.601c0,-0.001 0,-0.001 0,-0.002c0,-0.379 0.308,-0.687 0.687,-0.687h2.604c0.379,0 0.688,0.308 0.688,0.687c0,0.379 -0.308,0.687 -0.688,0.687h-1.917v1.23h1.917z" fill="#ffffff"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                            <!-- 他の共有リンクを追加 -->
                        </div>
                    </div>

                    @livewire('report-button', ['videoId' => $video->id])
                </div>
            </div>

            <div class="mt-6">
                <p>{{$video -> description}}</p>
            </div>


        </div>
    </section>

    <section class="mx-auto max-w-7xl py-6 px-6 lg:px-8">
        <div class="pb-4 border-b border-gray-600">
            <h3 class="text-xl font-semibold leading-6 text-gray-800">この人の他の動画</h3>
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