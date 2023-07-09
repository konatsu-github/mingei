<nav x-data="{ mobileMenuOpen: false, mobileSearchOpen:false }" class="fixed top-0 left-0 z-10 w-full bg-orange-400">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="py-3" x-transition.scale.10 x-show="mobileSearchOpen" @click.away="mobileSearchOpen = false">
            @include('components.search-form')
        </div>

        <div x-show="!mobileSearchOpen" class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <x-application-logo />
                </div>
                <div class="hidden lg:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        @if ( Route::currentRouteName() === 'home' )
                        <x-nav-link href="{{ route('home') }}" class="text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page" active>ホーム</x-nav-link>
                        @else
                        <x-nav-link href="{{ route('home') }}" class="text-white rounded-md px-3 py-2 text-sm font-medium">ホーム</x-nav-link>
                        @endif
                        @if ( Route::currentRouteName() === 'ranking' )
                        <x-nav-link href="{{ route('ranking') }}" class="text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page" active>ランキング</x-nav-link>
                        @else
                        <x-nav-link href="{{ route('ranking') }}" class="text-white rounded-md px-3 py-2 text-sm font-medium">ランキング</x-nav-link>
                        @endif
                        @if ( Route::currentRouteName() === 'recommend' )
                        <x-nav-link href="{{ route('recommend') }}" class="text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page" active>おすすめ</x-nav-link>
                        @else
                        <x-nav-link href="{{ route('recommend') }}" class="text-white rounded-md px-3 py-2 text-sm font-medium">おすすめ</x-nav-link>
                        @endif
                        @if ( Route::currentRouteName() === 'history' )
                        <x-nav-link href="{{ route('history') }}" class="text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page" active>履歴</x-nav-link>
                        @else
                        <x-nav-link href="{{ route('history') }}" class="text-white rounded-md px-3 py-2 text-sm font-medium">履歴</x-nav-link>
                        @endif
                        <!-- Current: "bg-yellow-400 text-white", Default: "text-gray-300 hover:bg-orange-300 hover:text-white" -->
                    </div>
                </div>
            </div>
            <div class="hidden lg:block">
                @include('components.search-form')
            </div>
            @auth
            <div class="hidden lg:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <button onclick="" type="button" class="relative rounded-full bg-orange-400 p-1 text-white hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                        <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900">20</div>
                    </button>

                    <!-- Profile dropdown -->
                    <div x-data="{ userMenuOpen: false }" class="relative ml-3">
                        <div>
                            <button @click="userMenuOpen = true" type="button" class="flex max-w-xs items-center rounded-full bg-orange-400 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            </button>
                        </div>


                        <!--
                Dropdown menu, show/hide based on menu state.

                Entering: "transition ease-out duration-100"
                  From: "transform opacity-0 scale-95"
                  To: "transform opacity-100 scale-100"
                Leaving: "transition ease-in duration-75"
                  From: "transform opacity-100 scale-100"
                  To: "transform opacity-0 scale-95"
              -->
                        <div x-transition.scale.10 x-show="userMenuOpen" @click.away="userMenuOpen = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <a href="{{ route('upload') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">動画アップロード</a>
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">プロフィール</a>
                            <a href="{{ route('setting') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">設定</a>
                            <div id="user-menu-item-2">
                                <!-- Authentication -->
                                <form class="p-0" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <input class="block px-4 py-2 text-sm text-gray-700 cursor-pointer w-full text-left" type="submit" value="ログアウト">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="hidden lg:block">
                <div class="flex items-center">
                    <x-nav-link href="{{ route('login') }}" class="text-white rounded-md px-3 py-2 text-sm font-medium">ログイン</x-nav-link>
                    <x-nav-link href="{{ route('register') }}" class="text-white rounded-md px-3 py-2 text-sm font-medium">会員登録</x-nav-link>
                </div>
            </div>
            @endauth
            <div class="-mr-2 flex lg:hidden">
                <!-- モバイルメニュー検索ボタン -->
                <button @click="mobileSearchOpen = true" class="mr-4 inline-flex items-center justify-center rounded-md bg-orange-400 p-2 text-white hover:bg-orange-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                    <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </button>
                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = true" type="button" class="inline-flex items-center justify-center rounded-md bg-orange-400 p-2 text-white hover:bg-orange-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-transition.scale.10 x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" class="lg:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">

            @if ( Route::currentRouteName() === 'home' )
            <x-nav-link href="{{ route('home') }}" class="block rounded-md px-3 py-2 text-base font-medium" aria-current="page" active>ホーム</x-nav-link>
            @else
            <x-nav-link href="{{ route('home') }}" class="block rounded-md px-3 py-2 text-base font-medium">ホーム</x-nav-link>
            @endif
            @if ( Route::currentRouteName() === 'ranking' )
            <x-nav-link href="{{ route('ranking') }}" class="block rounded-md px-3 py-2 text-base font-medium" aria-current="page" active>ランキング</x-nav-link>
            @else
            <x-nav-link href="{{ route('ranking') }}" class="block rounded-md px-3 py-2 text-base font-medium">ランキング</x-nav-link>
            @endif
            @if ( Route::currentRouteName() === 'recommend' )
            <x-nav-link href="{{ route('recommend') }}" class="block rounded-md px-3 py-2 text-base font-medium" aria-current="page" active>おすすめ</x-nav-link>
            @else
            <x-nav-link href="{{ route('recommend') }}" class="block rounded-md px-3 py-2 text-base font-medium">おすすめ</x-nav-link>
            @endif
            @if ( Route::currentRouteName() === 'history' )
            <x-nav-link href="{{ route('history') }}" class="block rounded-md px-3 py-2 text-base font-medium" aria-current="page" active>履歴</x-nav-link>
            @else
            <x-nav-link href="{{ route('history') }}" class="block rounded-md px-3 py-2 text-base font-medium">履歴</x-nav-link>
            @endif
        </div>

        @auth
        <div class="border-t border-gray-700 pb-3 pt-4">
            <div class="flex items-center px-5">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium leading-none text-white">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium leading-none text-white">{{ Auth::user()->email }}</div>
                </div>
                <button onclick="" class="relative ml-auto flex-shrink-0 rounded-full bg-orange-400 p-1 text-white hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                    <span class="sr-only">View notifications</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                    <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900">20</div>
                </button>
            </div>
            <div class="mt-3 space-y-1 px-2">
                <a href="{{ route('upload') }}" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-orange-300 hover:text-white">動画アップロード</a>
                <a href="{{ route('profile') }}" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-orange-300 hover:text-white">プロフィール</a>
                <a href="{{ route('setting') }}" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-orange-300 hover:text-white">設定</a>
                <div id="user-menu-item-2">
                    <!-- Authentication -->
                    <form class="p-0" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <input class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-orange-300 hover:text-white cursor-pointer w-full text-left" type="submit" value="ログアウト">
                    </form>
                </div>

            </div>
        </div>
        @else
        <div class="border-t border-gray-700 pb-3 pt-4">
            <div class="mt-3 space-y-1 px-2">
                <a href="{{ route('login') }}" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-orange-300 hover:text-white">ログイン</a>
                <a href="{{ route('register') }}" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-orange-300 hover:text-white">会員登録</a>
            </div>
        </div>
        @endauth

    </div>
</nav>