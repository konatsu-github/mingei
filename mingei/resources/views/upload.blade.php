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
    @livewire('upload')


  </div>

</x-app-layout>