<div
    x-data="{ open: false }"
    @keydown.escape="open = false"
    @mouseover="open = true"
    @mouseenter="open = true"
    @mouseout="open = false"
    @mouseleave="open = false"
    @click.away="open = false"
    class="relative"
>
    {{ $slot }}

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute left-0 z-10 p-2 mt-2 text-sm leading-none text-white origin-top-left bg-black bg-opacity-75 rounded-sm shadow-lg"
        style="display: none;"
    >
        {{ $tooltip  }}
    </div>
</div>
