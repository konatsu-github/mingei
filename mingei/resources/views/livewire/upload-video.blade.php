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
   <div>
       <div x-data="{ file: null }">
           <form wire:submit.prevent="save" enctype="multipart/form-data">
               @csrf
               <div>{{ session('message') }}</div>
               <div class="space-y-12">
                   <div class="border-b border-gray-900/10 pb-12">
                       <h2 class="text-base font-semibold leading-7 text-gray-900">あなたのネタ動画をアップロードしてください</h2>
                       <p class="mt-1 text-sm leading-6 text-gray-600">※動画の長さは3分までです。</p>
                       <p class="mt-1 text-sm leading-6 text-gray-600">※動画の容量は150MBまでです。</p>

                       <div class="col-span-full">
                           <div x-show="file === null" class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                               <div class="text-center">
                                   <label for="file-upload">
                                       <svg class="mx-auto h-12 w-12 text-gray-300" fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48">
                                           <path d="m140-800 74 152h130l-74-152h89l74 152h130l-74-152h89l74 152h130l-74-152h112q24 0 42 18t18 42v520q0 24-18 42t-42 18H140q-24 0-42-18t-18-42v-520q0-24 18-42t42-18Zm0 212v368h680v-368H140Zm0 0v368-368Z" />
                                       </svg>
                                   </label>
                                   <div class="mt-4 text-sm leading-6 text-gray-600">
                                       <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-orange-400 focus-within:outline-none focus-within:ring-2 focus-within:ring-orange-400 focus-within:ring-offset-2 hover:text-indigo-500">
                                           <span>動画を選択</span>
                                           <input wire:model="video" id="file-upload" name="file-upload" type="file" class="sr-only" x-on:change="file = $event.target.files[0]">
                                       </label>
                                   </div>
                                   <p class="text-xs leading-5 text-gray-600">MP4, WebM, MOV, AVI, MKV, FLV, 3GP, WMV, の動画形式をサポートしています。</p>
                               </div>
                           </div>

                           <div x-show="file !== null">
                               <h3 class="mt-4 text-base font-semibold leading-7 text-gray-900">プレビュー</h3>
                               <video class="mt-2 w-full" controls x-bind:src="file !== null ? URL.createObjectURL(file) : null">
                                   ブラウザが<code>&lt;video&gt;</code>要素をサポートしていないか、JavaScriptが無効になっています。
                               </video>
                           </div>
                       </div>
                   </div>

                   <div class="mt-6 flex items-center justify-end gap-x-6">
                       <button @click="resetFileInput" type="button" class="text-sm font-semibold leading-6 text-gray-900">キャンセル</button>
                       <button type="submit" class="rounded-md bg-orange-400 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-400">アップロード</button>
                   </div>
               </div>

               <!-- ローダー部分 -->
               <div wire:loading wire:target="save" class="flex justify-center items-center h-32">
                   <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                       <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                       <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-1.647zM12 20c3.042 0 5.824-1.135 7.938-3l-1.647-3A7.962 7.962 0 0012 16v4zm5.938-10H12v4h4.938a7.962 7.962 0 001.415-3.648L17.937 10zm-11.876 0H4.646A7.962 7.962 0 006 13.647L2.647 15.29A7.965 7.965 0 010 12c0-1.116.232-2.184.647-3.155L6 10.353zM12 4c-3.042 0-5.824 1.135-7.938 3l1.647 3A7.962 7.962 0 0112 8V4zm-1.064 5h2.128A6.03 6.03 0 0012 7.064V9zm1.064 5v2.064A6.03 6.03 0 0013.064 15h-2.128zM9 12H6.937A6.03 6.03 0 007 13.936V12h2zm3-3v2H9V9h2zm0 4h2v2.064A6.03 6.03 0 0012.936 15H11v-2zm-1-4H9V9h2v2z"></path>
                   </svg>
                   <span class="text-gray-900">アップロード中...</span>
               </div>
               <!-- ... -->
           </form>
       </div>


       <script>
           function resetFileInput() {
               const input = document.getElementById('file-upload');
               input.value = '';
               // 追加したい場合は以下の行のコメントを解除してください。
               this.file = null;
               console.log('ファイルがリセット');
           }
           
       </script>
   </div>