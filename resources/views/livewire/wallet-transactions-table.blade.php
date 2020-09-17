<div>
    <div class="mb-4">
        <div class="sm:hidden">
            <select aria-label="Selected tab" class="block w-full form-select">
                @foreach ($availableFilters as $name => $label)
                    <option value="{{ $name }}" @if ($name === $filter) selected
                @endif>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="hidden sm:block">
            <nav class="flex space-x-4">
                @foreach ($availableFilters as $name => $label)
                    <button wire:click="setFilter('{{ $name }}')" @if ($name === $filter)
                        aria-current="page" class="px-6 py-2 text-sm font-medium leading-5 text-gray-800 bg-gray-200 rounded-md focus:outline-none focus:bg-gray-300" @else class="px-6 py-2 text-sm font-medium leading-5 text-gray-600 rounded-md hover:text-gray-800 focus:outline-none focus:text-gray-800 focus:bg-gray-200" @endif>
                {{ $label }}
                </button>
                @endforeach
            </nav>
        </div>
    </div>


    <div class="overflow-hidden bg-white shadow sm:rounded-md">
        <div :page="request()->input('page', 1)" wire:init="loadData" wire:poll.16000ms="loadData" class="relative">
            @if ($pagination)
                <x-loader-overlay wire:key="overlay" wire:loading.class="flex" wire:loading.class.remove="hidden" />
            @endif

            <table wire:key="table" class="hidden w-full divide-y divide-gray-100 md:table">
                <x-table-header :orderable="$orderable" :headers="$headers" :orderBy="$orderBy" />

                <tbody class="divide-y divide-gray-200">
                    @if ($pagination)
                        @foreach ($pagination as $row)
                            <x-transactions-table-row :row="$row" :headers="$headers" />
                        @endforeach
                    @else
                        <x-rows-loader :rows="$limit" :cols="count($headers)" />
                    @endif
                </tbody>
            </table>

            <div wire:key="responsive" class="flex flex-col">
                @if ($pagination)
                    @foreach ($pagination as $row)
                        <x-transactions-table-row :row="$row" :headers="$headers" :odd="$loop->odd"
                            :responsive="true" />
                    @endforeach
                @endif
            </div>

            @if (!$hidePagination && $pagination)
                <div class="hidden px-6 py-4 lg:block dark:bg-gray-100">
                    {{ $pagination->links() }}
                </div>
                <div class="px-6 py-4 lg:hidden">
                    {{ $pagination->links('pagination') }}
                </div>
            @endif
        </div>
    </div>
</div>
