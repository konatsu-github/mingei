<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">動画アップロード</h1>
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
        <x-alert />
        <div>
            <div x-data="{ videoFile: null, imageFile : null }">
                <form action="{{ route('video.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">基本情報</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">この情報は公開されません。</p>

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-4">
                                    <label for="title" class="block text-sm font-medium leading-6 text-gray-900">動画のタイトル</label>
                                    <div class="mt-2">
                                        <input id="title" name="title" type="text" autocomplete="title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-4">
                                    <label for="description" class="block text-sm font-medium leading-6 text-gray-900">動画の説明文</label>
                                    <div class="mt-2">
                                        <textarea name="description" id="description" rows="5" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6"></textarea>
                                    </div>
                                </div>

                            </div>

                            <h2 class="mt-10 text-base font-semibold leading-7 text-gray-900">あなたのネタ動画をアップロードしてください</h2>

                            <div class="col-span-full">
                                <div x-show="videoFile === null" class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                    <div class="text-center">
                                        <label for="video-upload">
                                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48">
                                                <path d="m140-800 74 152h130l-74-152h89l74 152h130l-74-152h89l74 152h130l-74-152h112q24 0 42 18t18 42v520q0 24-18 42t-42 18H140q-24 0-42-18t-18-42v-520q0-24 18-42t42-18Zm0 212v368h680v-368H140Zm0 0v368-368Z" />
                                            </svg>
                                        </label>
                                        <div class="mt-4 text-sm leading-6 text-gray-600">
                                            <label for="video-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-orange-400 focus-within:outline-none focus-within:ring-2 focus-within:ring-orange-400 focus-within:ring-offset-2 hover:text-indigo-500">
                                                <span>動画を選択</span>
                                                <input id="video-upload" name="video-upload" type="file" class="sr-only" x-on:change="videoFile = $event.target.files[0]">
                                            </label>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-600">MP4, WebM, MOV, AVI, MKV, FLV, 3GP, WMV, の動画形式をサポートしています。</p>
                                    </div>
                                </div>

                                <div x-show="videoFile !== null">
                                    <h3 class="mt-4 text-base font-semibold leading-7 text-gray-900">プレビュー</h3>
                                    <video class="mt-2 w-full" controls x-bind:src="videoFile !== null ? URL.createObjectURL(videoFile) : null">
                                        ブラウザが<code>&lt;video&gt;</code>要素をサポートしていないか、JavaScriptが無効になっています。
                                    </video>
                                </div>
                            </div>

                            <h2 class="mt-10 text-base font-semibold leading-7 text-gray-900">動画のサムネイル画像をアップロードしてください</h2>

                            <div class="col-span-full">
                                <div x-show="imageFile === null" class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                    <div class="text-center">
                                        <label for="image-upload">
                                            <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                            </svg>
                                        </label>
                                        <div class="mt-4 text-sm leading-6 text-gray-600">
                                            <label for="image-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-orange-400 focus-within:outline-none focus-within:ring-2 focus-within:ring-orange-400 focus-within:ring-offset-2 hover:text-indigo-500">
                                                <span>サムネイル画像を選択</span>
                                                <input id="image-upload" name="image-upload" type="file" class="sr-only" x-on:change="imageFile = $event.target.files[0]">
                                            </label>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-600">jpg, png の画像形式をサポートしています。</p>
                                    </div>
                                </div>

                                <div x-show="imageFile !== null">
                                    <h3 class="mt-4 text-base font-semibold leading-7 text-gray-900">プレビュー</h3>
                                    <img class="mt-2 w-full" controls x-bind:src="imageFile !== null ? URL.createObjectURL(imageFile) : null">
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button @click="resetInput" type="button" class="text-sm font-semibold leading-6 text-gray-900">キャンセル</button>
                            <button type="submit" class="rounded-md bg-orange-400 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-400">アップロード</button>
                        </div>
                    </div>

                </form>
            </div>


            <script>
                function resetInput() {
                    const videoInput = document.getElementById('video-upload');
                    const imageInput = document.getElementById('image-upload');
                    const titleInput = document.getElementById('title');
                    const descriptionTextarea = document.getElementById('description');


                    videoInput.value = '';
                    imageInput.value = '';
                    titleInput.value = '';
                    descriptionTextarea.value = '';

                    this.videoFile = null;
                    this.imageFile = null;
                }
            </script>
        </div>
    </div>



</x-app-layout>