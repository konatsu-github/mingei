<div class="flex flex-col mb-12 overflow-hidden">
    <a href="{{ route('watch', ['videoId' => intval($id)]) }}" class="flex-shrink-0">
        <img src="{{ $src }}" alt="{{ $alt }}">
    </a>
    <div class="flex flex-col justify-between flex-1">
        <div class="flex-1">
            <a href="{{ route('watch', ['videoId' => intval($id)]) }}" class="flex pt-3 space-x-1 text-sm text-gray-500">
                <time>{{ $publishedDays }}</time>
                <span aria-hidden="true">·</span>
                <span>{{ number_format($views) }} 回視聴</span>
            </a>
            <h3 class="text-2xl font-semibold leading-none tracking-tighter text-neutral-600"><a href="">{{ $title }}</a></h3>
            <p class="text-lg font-normal text-gray-500"><a href="{{ route('watch', ['videoId' => intval($id)]) }}">{{ $description }}</a></p>
            <a href="{{ $profileLink }}" class="flex items-center space-x-4 pt-3">
                <img class="h-8 w-8 rounded-full" src="{{ $profileImage }}" alt="">
                <div class="font-medium dark:text-white">
                    <div>{{ $name }}</div>
                    @if ($combiName)
                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $combiName }}</div>
                    @endif
                </div>
            </a>
            @if (isset($userId) && $userId == Auth::id())
            <form onsubmit="return formConfirm()" action="{{ route('video.destroy', ['videoId' => $id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="mt-6 w-full text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">動画を削除する</button>
            </form>
            <script>
                function formConfirm() {
                    return window.confirm('本当に動画を削除しますか？');
                }
            </script>
            @endif
        </div>
    </div>
</div>