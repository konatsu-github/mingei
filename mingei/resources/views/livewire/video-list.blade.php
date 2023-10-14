<div>
    <div class="relative mx-auto max-w-7xl">
        <div class="grid max-w-lg gap-12 mx-auto mt-12 lg:grid-cols-3 lg:max-w-none">
            @foreach ($videosItems as $videoItem)
            <x-video-list-item src="{!! $videoItem['thumbnailUrl'] !!}" alt="{{ $videoItem['description'] }}" publishedDays="{{ $videoItem['createdAt'] }}" views="{{ $videoItem['viewCount'] }}" title="{{ $videoItem['title'] }}" description="{{ $videoItem['description'] }}" id="{{ $videoItem['videoId'] }}" profileLink="{{ route('profile.show', ['id' => $videoItem['videoUserId']]) }}" profileImage="{!! $videoItem['avatarUrl'] !!}" name="{{ $videoItem['pinname'] }}" combiName="{{ $videoItem['combiname'] }}" />
            @endforeach
        </div>
    </div>
    @if ($loadMoreButtonVisible == false)
    <div class="mt-4 text-center">
        <x-button wire:click="loadMore">
        もっとよみこむ
        </x-button>
    </div>
    @endif
</div>