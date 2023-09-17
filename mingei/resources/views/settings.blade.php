<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">設定</h1>
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
        <form action="{{ route('profile.update') }}" x-data="{ imageFile : null }" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">一般公開情報</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">この情報は公開されます。共有する内容には注意してください。</p>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="nickname" class="block text-sm font-medium leading-6 text-gray-900">ニックネーム</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-orange-400 sm:max-w-md">
                                    <input type="text" name="nickname" value="{{ $userMeta->nickname }}" id="nickname" autocomplete="nickname" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="サイト内で表示されるあなたのニックネームを入力してください">
                                </div>
                            </div>
                        </div>
                        <div class="col-span-full">
                            <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">アバター画像</label>
                            <div class="mt-2 flex items-center gap-x-3">
                                <img class="h-10 w-10 rounded-full" x-bind:src="imageFile !== null ? URL.createObjectURL(imageFile) : '{{$avatarUrl}}'">
                                <input id="image-upload" name="image-upload" type="file" class="hidden sr-only" x-on:change="imageFile = $event.target.files[0]">
                                <label for="image-upload" class="cursor-pointer rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">変更する</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-b border-gray-900/10 pb-12">

                    <h2 class="text-base font-semibold leading-7 text-gray-900">芸人公開情報</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">この情報は公開されます。共有する内容には注意してください。</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                        <div class="sm:col-span-4">
                            <label for="pin_name" class="block text-sm font-medium leading-6 text-gray-900">芸名</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-orange-400 sm:max-w-md">
                                    <input type="text" name="pin_name" id="pin_name" value="{{ $userMeta->pinname }}" autocomplete="pin_name" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="あなたの芸名を入力してください">
                                </div>
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="combi_name" class="block text-sm font-medium leading-6 text-gray-900">コンビ名</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-orange-400 sm:max-w-md">
                                    <input type="text" name="combi_name" id="combi_name" value="{{ $userMeta->combiname }}" autocomplete="combi_name" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="コンビやトリオなどのときのコンビ名を入力してください">
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-span-full">
                            <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Cover photo</label>
                            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                    </svg>
                                    <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                        <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-orange-400 focus-within:outline-none focus-within:ring-2 focus-within:ring-orange-400 focus-within:ring-offset-2 hover:text-orange-500">
                                            <span>Upload a file</span>
                                            <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">基本情報</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">この情報は公開されません。</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">お名前</label>
                            <div class="mt-2">
                                <input id="name" name="name" type="text" value="{{ $user->name }}" autocomplete="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-4">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">メールアドレス</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" value="{{ $user->email }}" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                    </div>
                </div>
                <!-- 
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Notifications</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">We'll always let you know about important changes, but you pick what else you want to hear about.</p>

                    <div class="mt-10 space-y-10">
                        <fieldset>
                            <legend class="text-sm font-semibold leading-6 text-gray-900">By Email</legend>
                            <div class="mt-6 space-y-6">
                                <div class="relative flex gap-x-3">
                                    <div class="flex h-6 items-center">
                                        <input id="comments" name="comments" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-orange-400 focus:ring-orange-400">
                                    </div>
                                    <div class="text-sm leading-6">
                                        <label for="comments" class="font-medium text-gray-900">Comments</label>
                                        <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p>
                                    </div>
                                </div>
                                <div class="relative flex gap-x-3">
                                    <div class="flex h-6 items-center">
                                        <input id="candidates" name="candidates" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-orange-400 focus:ring-orange-400">
                                    </div>
                                    <div class="text-sm leading-6">
                                        <label for="candidates" class="font-medium text-gray-900">Candidates</label>
                                        <p class="text-gray-500">Get notified when a candidate applies for a job.</p>
                                    </div>
                                </div>
                                <div class="relative flex gap-x-3">
                                    <div class="flex h-6 items-center">
                                        <input id="offers" name="offers" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-orange-400 focus:ring-orange-400">
                                    </div>
                                    <div class="text-sm leading-6">
                                        <label for="offers" class="font-medium text-gray-900">Offers</label>
                                        <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="text-sm font-semibold leading-6 text-gray-900">Push Notifications</legend>
                            <p class="mt-1 text-sm leading-6 text-gray-600">These are delivered via SMS to your mobile phone.</p>
                            <div class="mt-6 space-y-6">
                                <div class="flex items-center gap-x-3">
                                    <input id="push-everything" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-orange-400 focus:ring-orange-400">
                                    <label for="push-everything" class="block text-sm font-medium leading-6 text-gray-900">Everything</label>
                                </div>
                                <div class="flex items-center gap-x-3">
                                    <input id="push-email" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-orange-400 focus:ring-orange-400">
                                    <label for="push-email" class="block text-sm font-medium leading-6 text-gray-900">Same as email</label>
                                </div>
                                <div class="flex items-center gap-x-3">
                                    <input id="push-nothing" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-orange-400 focus:ring-orange-400">
                                    <label for="push-nothing" class="block text-sm font-medium leading-6 text-gray-900">No push notifications</label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div> -->

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button @click="resetInput" type="button" class="text-sm font-semibold leading-6 text-gray-900">キャンセル</button>
                    <button type="submit" class="rounded-md bg-orange-400 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-400">保存</button>
                </div>
        </form>

    </div>

    <script>
        /** キャンセルボタンクリック時 */
        function resetInput() {
            const imageInput = document.getElementById('image-upload');

            imageInput.value = '';

            this.imageFile = null;
        }
    </script>
</x-app-layout>