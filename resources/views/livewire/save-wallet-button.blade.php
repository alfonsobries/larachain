<button
    class="relative flex items-center justify-center w-10 h-10 transition duration-150 ease-in-out border border-red-200 rounded-full hover:bg-red-100"
    wire:loading.class="animate-pulse" wire:loading.attr="disabled" wire:click="saveWallet">

    @if($isSaved)
    <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
            clip-rule="evenodd"></path>
    </svg>
    @else
    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
        </path>
    </svg>
    @endif

    @if (session()->has('walletSaved'))
    <div
        class="absolute right-0 p-3 text-sm leading-none text-green-700 bg-green-100 rounded shadow mt-14 w-52"
        wire:poll
    >
        @if($isSaved)
        Wallet added to your list
        @else
        Wallet removed from your list
        @endif
    </div>
    @endif
</button>
