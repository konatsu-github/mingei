@if (!auth()->check() || $videoUserId != auth()->user()->id)
<div>
    <button wire:click="toggleSave" class="{{ $isSaved ? 'bg-orange-400 text-white' : '' }} flex items-center space-x-1 p-2 whitespace-nowrap mr-2 outline-none ring-2 ring-gray-300 font-medium rounded-full text-sm text-center">
        <svg class="{{ $isSaved ? 'fill-white' : '' }} w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M19 19H5V5h7V3H5C3.89 3 3 3.89 3 5v14c0 1.1.89 2 2 2h14c1.11 0 2-.9 2-2v-7h-2v7zm2-10h-7V3l9 9zm-9 2V9h-2v4H8l4 4 4-4h-3z" />
        </svg>
        <span>
            @if ($isSaved)
            保存中
            @else
            保存
            @endif
        </span>
    </button>
</div>
@endif