<div :page="request()->input('page', 1)" wire:init="loadData" wire:poll.16000ms="loadData" class="relative">
    @if ($pagination)
        <x-loader-overlay wire:key="overlay" wire:loading.class="flex" wire:loading.class.remove="hidden" />
    @endif

    <table wire:key="table" class="hidden w-full divide-y divide-gray-100 dark:divide-gray-800 md:table">
        <x-table-header :orderable="[]" :headers="$headers" :orderBy="$orderBy" />

        <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
            @if ($pagination)
                @foreach ($pagination as $row)
                <x-wallets-table-row :row="$row" :headers="$headers" />
                @endforeach
            @else
            
                <x-rows-loader :rows="$limit" :cols="count($headers)" />
            @endif
        </tbody>
    </table>

    <div wire:key="responsive" class="flex flex-col">
        @if ($pagination)
            @foreach ($pagination as $row)
                <x-wallets-table-row :row="$row" :headers="$headers" :odd="$loop->odd" :responsive="true" />
            @endforeach
        @endif
    </div>
    
    @if (!$hidePagination && $pagination)
    <div class="hidden px-6 py-4 lg:block">
        {{ $pagination->links('full-pagination') }}
    </div>
    <div class="px-6 py-4 lg:hidden">
        {{ $pagination->links('pagination') }}
    </div>
    @endif
</div>
