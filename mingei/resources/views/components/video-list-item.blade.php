<div class="flex flex-col mb-12 overflow-hidden">
    <a href="{{ route('watch')}}?id={{$id}}" class="flex-shrink-0">
        <img src="{{ $src }}" alt="{{ $alt }}">
    </a>
    <div class="flex flex-col justify-between flex-1">
        <div class="flex-1">
            <a href="{{ route('watch')}}?id={{$id}}" class="flex pt-6 space-x-1 text-sm text-gray-500">
                <time>{{ $publishedDays }}</time>
                <span aria-hidden="true">·</span>
                <span>{{ number_format($views) }} 回視聴</span>
            </a>
            <h3 class="text-2xl font-semibold leading-none tracking-tighter text-neutral-600"><a href="{{ route('watch')}}?id={{$id}}">{{ $title }}</a></h3>
            <p class="text-lg font-normal text-gray-500"><a href="{{ route('watch')}}?id={{$id}}">{{ $description }}</a></p>
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