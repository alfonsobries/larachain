<div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    @if($backUrl)
    <nav class="sm:hidden">
        <a
            href="{{ $backUrl }}"
            class="flex items-center text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700">
            <svg class="flex-shrink-0 w-5 h-5 mr-1 -ml-1 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
            </svg>
            
            Back
        </a>
    </nav>
    @endif

    <nav class="items-center hidden text-sm font-medium leading-5 sm:flex">
        @foreach($items as $item)
            <a href="{{ $item['url'] }}" class="text-gray-500 transition duration-150 ease-in-out hover:text-gray-700">{{ $item['label'] }}</a>
        
            <svg class="flex-shrink-0 w-5 h-5 mx-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd" />
            </svg>
        @endforeach
    </nav>
</div>
