<div {{ $attributes->merge(['class' => 'p-4 rounded-md bg-green-50']) }}>
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="w-5 h-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium leading-5 text-green-800">
                {{ $slot }}
            </p>
        </div>
    </div>
</div>
