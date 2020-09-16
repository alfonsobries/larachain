<div>
    @isset($breadcrumb)
        {{ $breadcrumb }}
    @endisset
            
    <div class="px-4 mx-auto mt-2 md:flex md:items-center md:justify-between max-w-7xl sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 truncate sm:text-3xl sm:leading-9">
                {{ $title }}
            </h2>
        </div>

        @if(count($actions))
        <div class="flex flex-shrink-0 mt-4 space-x-4 md:mt-0 md:ml-4">
            @foreach($actions as $action)
            <x-button :href="$action['url']" :variant="$action['variant']">
                {{ $action['label']}}
            </x-button>
            @endforeach
        </div>
        @endif
    </div>
</div>