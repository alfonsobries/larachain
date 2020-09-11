<div class="flex items-center -mr-2 sm:hidden">
    <button @click="open = !open"
        class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500"
        x-bind:aria-label="open ? 'Close main menu' : 'Main menu'" x-bind:aria-expanded="open"
        aria-label="Main menu">
        <svg x-state:on="Menu open" x-state:off="Menu closed"
            :class="{ 'hidden': open, 'block': !open }" class="block w-6 h-6" stroke="currentColor"
            fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        <svg x-state:on="Menu open" x-state:off="Menu closed"
            :class="{ 'hidden': !open, 'block': open }" class="hidden w-6 h-6" stroke="currentColor"
            fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>