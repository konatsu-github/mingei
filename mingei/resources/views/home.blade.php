<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">ホーム</h1>
    </x-slot>
    <x-alert />
    <section>
        <div class="pb-4 border-b border-gray-600">
            <h3 class="text-xl font-semibold leading-6 text-gray-800">みんなの動画</h3>
        </div>

        <div class="relative mx-auto max-w-7xl">
            <div class="grid max-w-lg gap-12 mx-auto mt-12 lg:grid-cols-3 lg:max-w-none">
                @foreach ($videosItems as $videoItem)
                <x-video-list-item src="{!! $videoItem['thumbnailUrl'] !!}" alt="{{ $videoItem['video']->description }}" publishedDays="{{$videoItem['video'] -> created_at->format('Y/m/d')}}" views="{{ $videoItem['video']->view_count }}" title="{{ $videoItem['video']->title }}" description="{{ $videoItem['video']->description }}" id="{{ $videoItem['video']->id }}" profileLink="{{ route('profile.show', ['id' => $videoItem['video']->user_id]) }}" profileImage="{!! $videoItem['avatarUrl'] !!}" name="{{ $videoItem['usermeta']->pinname ?: $videoItem['usermeta']->nickname }}" combiName="{{ $videoItem['usermeta']->combiname }}" />
                @endforeach
            </div>
        </div>


    </section>
</x-app-layout>