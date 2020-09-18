<div class="hidden sm:ml-6 sm:flex sm:items-center">
    @guest
        <div class="flex flex-shrink-0 mt-4 space-x-4 md:mt-0 md:ml-4">
            <x-button href="{{ route('login') }}" variant="secondary" class="block">
                Sign in
            </x-button>
            <x-button href="{{ route('register') }}">
                Sign up
            </x-button>
        </div>
    @endguest

    @auth
        <div @click.away="open = false" class="relative ml-3" x-data="{ open: false }">
            <div>
                <button @click="open = !open"
                    class="flex text-sm transition duration-150 ease-in-out border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300"
                    id="user-menu" aria-label="User menu" aria-haspopup="true" :earia-expanded="open">
                    <img class="w-8 h-8 rounded-full" src="{{ auth()->user()->profile_photo_url }}" alt="User photo">
                </button>
            </div>

            <div
                x-show="open"
                x-description="Profile dropdown panel, show/hide based on dropdown state."
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 w-48 mt-2 origin-top-right rounded-md shadow-lg"
                style="display: none;"
            >
                <div class="py-1 bg-white rounded-md shadow-xs" role="menu" aria-orientation="vertical"
                    aria-labelledby="user-menu">

                    <a href="{{ route('profile.show') }}"
                        class="block px-4 py-2 text-sm text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100"
                        role="menuitem">Settings</a>
                        
                    <button
                        wire:loading.attr="disabled"
                        wire:click="logout"
                        class="w-full px-4 py-2 text-sm text-left text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 disabled:opacity-50"
                        role="menuitem"
                    >Sign out</button>
                </div>
            </div>
        </div>
    @endauth
    

    <livewire:settings-button />
</div>
