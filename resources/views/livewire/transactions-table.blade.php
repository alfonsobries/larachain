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
                <x-transactions-table-row :row="$row" :headers="$headers" :odd="$loop->odd" :responsive="true" />
            @endforeach
        @endif
    </div>
</div>
