<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">ホーム</h1>
    </x-slot>

    <section>
        <div class="pb-4 border-b border-gray-600">
            <h3 class="text-xl font-semibold leading-6 text-gray-800">みんなの動画</h3>
        </div>

        <div class="relative mx-auto max-w-7xl">
            <div class="grid max-w-lg gap-12 mx-auto mt-12 lg:grid-cols-3 lg:max-w-none">
                @foreach ($videos as $video)
                <x-video-list-item src="{{ $video->image_file_path }}" alt="{{ $video->description }}" publishedDays="" views="{{ $video->view_count }}" title="{{ $video->title }}" description="{{ $video->description }}" id="{{ $video->id }}" profileLink="#" profileImage="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" name="田中レモン" combiName="有線電車" />
                @endforeach

            </div>
        </div>


    </section>
</x-app-layout>