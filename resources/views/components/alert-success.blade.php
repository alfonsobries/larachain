<div x-data="{show: true}" x-show="show"
    {{ $attributes->merge(['class' => 'relative z-20 p-4 border-l-4 border-green-500 dark:border-green-400 shadow-sm bg-green-50 dark:bg-green-900']) }}>
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="w-5 h-5 text-green-400 dark:text-green-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium leading-5 text-green-800 dark:text-green-100">
                {{ $slot }}
            </p>
        </div>
        <div class="pl-3 ml-auto">
            <div class="-mx-1.5 -my-1.5">
                <button
                    class="inline-flex rounded-md p-1.5 text-green-500 dark:text-green-100 hover:bg-green-100 dark:hover:bg-green-600 focus:outline-none focus:bg-green-100 transition ease-in-out duration-150"
                    aria-label="Dismiss" type="button" @click="show=false">
                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
