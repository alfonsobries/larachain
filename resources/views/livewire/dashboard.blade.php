<div class="flex flex-col space-y-4 xl:space-y-0 xl:grid-cols-2 xl:gap-4 xl:grid">
    <div class="bg-white rounded shadow">
        <x-title-h3 class="flex justify-between px-4 py-2 border-b border-gray-200">
            Latest blocks

            <a href="#" class="flex items-center px-2 text-sm text-blue-600 rounded border-200 hover:bg-blue-100">
                <span class="leading-none">View all</span>

                <svg class="w-4 h-4 ml-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </x-title-h3>
        <livewire:block-table />
    </div>
    <div class="bg-white rounded shadow">
        <x-title-h3 class="px-4 py-2 border-b border-gray-100">Latest transactions</x-title-h3>
        <div class="py-2">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus veritatis accusamus fugiat architecto fuga cupiditate, vel impedit recusandae quod eius molestias voluptatum maiores tempore dolore, inventore obcaecati repellat nostrum debitis!</p>
        </div>
    </div>
</div>