<div x-description="Mobile menu, toggle classes based on menu state." x-state:on="Open" x-state:off="closed"
    :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
        @foreach ($menuItems as $item)
            <a @isset($item['route']) href="{{ route($item['route']) }}" @else href="{{ $item['href'] }}" @endisset
                @if (isset($item['route']) && $item['route'] === Route::currentRouteName())
                class="flex py-3 pl-3 pr-4 text-base font-medium text-gray-800 transition duration-150 ease-in-out border-l-4 border-red-800 bg-gray-50 dark:bg-gray-800 dark:text-gray-100 focus:outline-none focus:text-gray-600 focus:bg-gray-100 focus:border-gray-300"
            @else
                class="flex py-3 pl-3 pr-4 text-base font-medium text-gray-600 transition duration-150 ease-in-out border-l-4 border-transparent hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300"
        @endif
        >
        @isset($item['icon'])
            {!! $item['icon'] !!}
        @endisset
        {{ $item['label'] }}
        </a>
        @endforeach
    </div>

    @guest
        <div class="flex flex-col p-4 space-y-4 border-t border-gray-100 dark:border-gray-600">
            <x-button href="{{ route('login') }}" variant="secondary">
                Sign in
            </x-button>
            <x-button href="{{ route('register') }}">
                Sign up
            </x-button>
        </div>
    @endguest

    @auth
        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="flex items-center px-4 space-x-3">
                <div class="flex-shrink-0">
                    <img class="w-10 h-10 rounded-full" src="{{ auth()->user()->profile_photo_url }}" alt="User photo">
                </div>
                <div>
                    <div class="text-base font-medium leading-6 text-gray-800 dark:text-gray-300">{{ auth()->user()->name }}</div>
                    <div class="text-sm font-medium leading-5 text-gray-500">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                <a href="{{ route('profile.show') }}"
                    class="block px-4 py-2 text-base font-medium text-gray-500 transition duration-150 ease-in-out hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100"
                    role="menuitem">Settings</a>

                <button
                    wire:loading.attr="disabled"
                    wire:click="logout"
                    class="block w-full px-4 py-2 text-base font-medium text-left text-gray-500 transition duration-150 ease-in-out hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 disabled:opacity-50"
                    role="menuitem"
                >Sign out</button>
            </div>
        </div>
    @endauth
</div>
