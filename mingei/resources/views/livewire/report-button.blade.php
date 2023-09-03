<div x-data="{ showModal: false }">
    <button x-on:click="showModal = true" class="flex items-center space-x-1 p-2 bg-white whitespace-nowrap mr-2 outline-none ring-2 ring-gray-300 font-medium rounded-full text-sm text-center">
        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path d="M200-120v-680h343l19 86h238v370H544l-18.933-85H260v309h-60Zm300-452Zm95 168h145v-250H511l-19-86H260v251h316l19 85Z" />
        </svg>
        <span>報告</span>
    </button>

    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-opacity-75 bg-gray-900">
        <div x-on:click.away="showModal = false" class="bg-white p-6 rounded-lg">
            <h2 class="text-xl font-semibold mb-4">報告</h2>
            <p>報告の理由を書いてください</p>
            <textarea wire:model="reportReason" class="w-full p-2 border rounded mb-4"></textarea>
            <button x-on:click="showModal = false" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">キャンセル</button>
            <button wire:click="sendReport" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">報告する</button>
        </div>
    </div>
</div>


