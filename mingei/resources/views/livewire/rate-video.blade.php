<div class="flex items-center mt-8">
    <button wire:click="rateGoodVideo" class="{{ $isActiveGood ? 'bg-red-500 text-white' : '' }} mr-6 flex items-center outline-none ring-2 ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 text-center">
        <svg class="{{ $isActiveGood ? 'fill-white' : '' }} w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path d="M480-261q66 0 121.5-35.5T682-393H278q26 61 81 96.5T480-261ZM302-533l45-45 45 45 36-36-81-81-81 81 36 36Zm267 0 45-45 45 45 36-36-81-81-81 81 36 36ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 340q142.375 0 241.188-98.812Q820-337.625 820-480t-98.812-241.188Q622.375-820 480-820t-241.188 98.812Q140-622.375 140-480t98.812 241.188Q337.625-140 480-140Z" />
        </svg>
        いいね ({{ formatNumber($goodCount) }})
    </button>
    <button wire:click="rateBadVideo" class="{{ $isActiveBad ? 'bg-blue-500 text-white' : '' }} flex items-center outline-none ring-2 ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 text-center">
        <svg class="{{ $isActiveBad ? 'fill-white' : '' }} w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path d="M626-533q22.5 0 38.25-15.75T680-587q0-22.5-15.75-38.25T626-641q-22.5 0-38.25 15.75T572-587q0 22.5 15.75 38.25T626-533Zm-292 0q22.5 0 38.25-15.75T388-587q0-22.5-15.75-38.25T334-641q-22.5 0-38.25 15.75T280-587q0 22.5 15.75 38.25T334-533Zm146.174 116Q413-417 358.5-379.5T278-280h53q22-42 62.173-65t87.5-23Q528-368 567.5-344.5T630-280h52q-25-63-79.826-100-54.826-37-122-37ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 340q142.375 0 241.188-98.812Q820-337.625 820-480t-98.812-241.188Q622.375-820 480-820t-241.188 98.812Q140-622.375 140-480t98.812 241.188Q337.625-140 480-140Z" />
        </svg>
        うーん
        @if (auth()->check() && $videoUserId == auth()->user()->id)
        ({{ formatNumber($badCount) }})
        @endif
    </button>
</div>