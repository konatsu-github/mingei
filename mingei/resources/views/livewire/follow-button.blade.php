@if (!auth()->check() || $videoUserId != auth()->user()->id)
<div>
    @if (in_array($videoUserId, $follows))
    <button wire:click="toggleFollow" class="bg-orange-400 text-white flex items-center space-x-1 p-2 whitespace-nowrap mr-2 outline-none ring-2 ring-gray-300 font-medium rounded-full text-sm text-center">
        <svg class="fill-white w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path d="M730-400v-130H600v-60h130v-130h60v130h130v60H790v130h-60Zm-370-81q-66 0-108-42t-42-108q0-66 42-108t108-42q66 0 108 42t42 108q0 66-42 108t-108 42ZM40-160v-94q0-35 17.5-63.5T108-360q75-33 133.338-46.5 58.339-13.5 118.5-13.5Q420-420 478-406.5 536-393 611-360q33 15 51 43t18 63v94H40Zm60-60h520v-34q0-16-9-30.5T587-306q-71-33-120-43.5T360-360q-58 0-107.5 10.5T132-306q-15 7-23.5 21.5T100-254v34Zm260-321q39 0 64.5-25.5T450-631q0-39-25.5-64.5T360-721q-39 0-64.5 25.5T270-631q0 39 25.5 64.5T360-541Zm0-90Zm0 411Z" />
        </svg>
        <span>フォロー中</span>
    </button>
    @else
    <button wire:click="toggleFollow" class="flex items-center space-x-1 p-2 whitespace-nowrap mr-2 outline-none ring-2 ring-gray-300 font-medium rounded-full text-sm text-center">
        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path d="M730-400v-130H600v-60h130v-130h60v130h130v60H790v130h-60Zm-370-81q-66 0-108-42t-42-108q0-66 42-108t108-42q66 0 108 42t42 108q0 66-42 108t-108 42ZM40-160v-94q0-35 17.5-63.5T108-360q75-33 133.338-46.5 58.339-13.5 118.5-13.5Q420-420 478-406.5 536-393 611-360q33 15 51 43t18 63v94H40Zm60-60h520v-34q0-16-9-30.5T587-306q-71-33-120-43.5T360-360q-58 0-107.5 10.5T132-306q-15 7-23.5 21.5T100-254v34Zm260-321q39 0 64.5-25.5T450-631q0-39-25.5-64.5T360-721q-39 0-64.5 25.5T270-631q0 39 25.5 64.5T360-541Zm0-90Zm0 411Z" />
        </svg>
        <span>フォロー</span>
    </button>
    @endif
</div>
@endif