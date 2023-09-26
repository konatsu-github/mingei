<div wire:ignore wire:init="notificationRead" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <ul class="space-y-1 text-gray-500 list-inside dark:text-gray-400">
            @foreach ($notifications as $notification)
            <div class="notification">
                @if ($notification->read_at)
                <li class="flex items-center">
                    <svg class="w-3.5 h-3.5 mr-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <div>
                        <time>{{ $notification->created_at->format('n月j日G時i分') }}</time> {!! $notification->data !!}
                    </div>
                </li>
                @else
                <li class="flex items-center">
                    <svg class="w-3.5 h-3.5 mr-2 text-gray-500 dark:text-gray-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <div>
                        <time>{{ $notification->created_at->format('n月j日G時i分') }}</time> {!! $notification->data !!}
                    </div>
                </li>
                @endif
            </div>
            @endforeach
        </ul>
    </div>
</div>