<div class="flex flex-col mb-12 overflow-hidden">
    <div class="flex-shrink-0">
        <video controls @if ($poster) poster="{{ $poster }}" @endif>
            <source src="{{ $src }}" type="video/mp4">
            {{ $alt }}
        </video>
    </div>
    <div class="flex flex-col justify-between flex-1">
        <div class="flex-1">
            <div class="flex pt-6 space-x-1 text-sm text-gray-500">
                <time datetime="{{ $datetime }}">{{ $date }}</time>
                <span aria-hidden="true">·</span>
                <span>{{ number_format($views) }} 回視聴</span>
            </div>
            <h3 class="text-2xl font-semibold leading-none tracking-tighter text-neutral-600">{{ $title }}</h3>
            <p class="text-lg font-normal text-gray-500">{{ $description }}</p>
            <a href="{{ $profileLink }}" class="flex items-center space-x-4">
                <img class="h-8 w-8 rounded-full" src="{{ $profileImage }}" alt="">
                <div class="font-medium dark:text-white">
                    <div>{{ $name }}</div>
                    @if ($combiName)
                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $combiName }}</div>
                    @endif
                </div>
            </a>
        </div>
    </div>
</div>