<div>
    @isset($breadcrumb)
        {{ $breadcrumb }}
    @endisset
            
    <div class="px-4 mx-auto mt-2 md:flex md:items-center md:justify-between max-w-7xl sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                {{ $title }}
            </h2>
        </div>
        {{-- <div class="flex flex-shrink-0 mt-4 md:mt-0 md:ml-4">
            <span class="rounded-md shadow-sm">
                <button type="button"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-teal focus:border-teal-300 active:text-gray-800 active:bg-gray-50">
                    Edit
                </button>
            </span>
            <span class="ml-3 rounded-md shadow-sm">
                <button type="button"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-teal-600 border border-transparent rounded-md hover:bg-teal-500 focus:outline-none focus:shadow-outline-teal focus:border-teal-700 active:bg-teal-700">
                    Publish
                </button>
            </span>
        </div> --}}
    </div>
</div>