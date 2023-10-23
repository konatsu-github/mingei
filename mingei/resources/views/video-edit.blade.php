<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">動画情報編集</h1>
    </x-slot>
    <div class="py-12">
        <!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->

        <form action="{{ route('video.update', ['videoId' => $video->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">動画情報</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">動画とサムネイル画像の編集はできませんのでご了承ください</p>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="title" class="block text-sm font-medium leading-6 text-gray-900">タイトル</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-orange-400 sm:max-w-md">
                                    <input type="text" name="title" id="title" value="{{ $video->title }}" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="description" class="block text-sm font-medium leading-6 text-gray-900">説明文</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-orange-400 sm:max-w-md">
                                    <textarea id="description" name="description" rows="5" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">{{ $video->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button onclick="reloadPage()" type="button" class="text-sm font-semibold leading-6 text-gray-900">キャンセル</button>
                    <button type="submit" class="rounded-md bg-orange-400 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-400">保存</button>
                </div>
            </div>
        </form>

    </div>

    <script>
        /** キャンセルボタンクリック時 */
        function reloadPage() {
            window.location.reload();
        }
    </script>

</x-app-layout>