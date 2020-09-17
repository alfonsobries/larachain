<nav
    x-data="{ open: false }"
    class="relative bg-white border-b-2 border-gray-100 dark:border-gray-800 dark:bg-gray-900"
>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <x-logo />


                <div class="hidden space-x-8 sm:ml-6 sm:flex -mb-0.5">
                    @foreach($menuItems as $item)
                    <a
                        @isset($item['route'])
                        href="{{ route($item['route']) }}"
                        @else
                        href="{{ $item['href'] }}"
                        @endisset
                        
                        @if(isset($item['route']) && $item['route'] === Route::currentRouteName())
                        class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 transition duration-150 ease-in-out border-b-2 border-red-700 dark:text-gray-300 focus:outline-none focus:border-red-500"
                        @else
                        class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out border-b-2 border-transparent dark:text-gray-100 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 dark:hover:border-gray-600 "
                        @endif
                    >
                        @isset($item['icon'])
                            {!! $item['icon'] !!}
                        @endisset
                        {{ $item['label'] }}
                    </a>
                    @endforeach
                </div>
            </div>

            <livewire:user-menu />

            <x-layout.mobile-menu-button />
        </div>
    </div>

    <livewire:mobile-user-menu :menu-items="$menuItems" />
</nav>
