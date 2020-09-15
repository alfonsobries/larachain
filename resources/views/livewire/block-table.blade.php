<div :page="request()->input('page', 1)" wire:init="loadData" wire:poll.16000ms="loadData" class="relative">
    @if ($pagination)
        <x-loader-overlay wire:key="overlay" wire:loading.class="flex" wire:loading.class.remove="hidden" />
    @endif

    <table wire:key="table" class="hidden w-full divide-y divide-gray-100 md:table">
        <x-table-header :orderable="$orderable" :headers="$headers" :orderBy="$orderBy" />

        <tbody class="divide-y divide-gray-200">
            @if ($pagination)
                @foreach ($pagination as $row)
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium leading-5 text-gray-900 whitespace-no-wrap">
                            <x-tooltip :tooltip="$row['id']">
                                <x-link title="{{ $row['id'] }}" class="block w-20 truncate" href="#">{{ $row['id'] }}
                                </x-link>
                            </x-tooltip>
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap">
                            <x-link href="#">{{ number_format($row['height']) }}</x-link>
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap">
                            <span>{{ \Carbon\Carbon::createFromTimestamp($row['timestamp']['unix'])->format('Y-m-d') }}</span>
                            <span>{{ \Carbon\Carbon::createFromTimestamp($row['timestamp']['unix'])->format('H:i:s') }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap">
                            <x-link>{{ \Arr::get($row, 'generator.username', 'Unknown') }}</x-link>
                        </td>
                    </tr>
                @endforeach
            @else
                <x-rows-loader :rows="$limit" :cols="count($headers)" />
            @endif
        </tbody>
    </table>

    <div wire:key="responsive" class="flex flex-col">
        @if ($pagination)
            @foreach ($pagination as $row)
                <div class="flex flex-wrap w-full md:hidden {{ $loop->odd ? 'bg-white' : 'bg-gray-100' }}">
                    <span class="w-1/3 px-6 py-3 text-sm font-semibold text-gray-500 uppercase">
                        ID:
                    </span>
                    <div class="w-2/3 px-6 py-3 text-gray-500 ">
                        <x-tooltip :tooltip="$row['id']">
                            <x-link title="{{ $row['id'] }}" class="block max-w-full truncate w-62" href="#">
                                {{ $row['id'] }}
                            </x-link>
                        </x-tooltip>
                    </div>
                    <span class="w-1/3 px-6 py-3 text-sm font-semibold text-gray-500 uppercase">
                        Height:
                    </span>
                    <div class="w-2/3 px-6 py-3 text-gray-500 ">
                        <x-link href="#">{{ number_format($row['height']) }}</x-link>
                    </div>
                    <span class="w-1/3 px-6 py-3 text-sm font-semibold text-gray-500 uppercase">
                        Time:
                    </span>
                    <div class="w-2/3 px-6 py-3 text-gray-500 ">
                        <span>{{ \Carbon\Carbon::createFromTimestamp($row['timestamp']['unix'])->format('Y-m-d') }}</span>
                        <span>{{ \Carbon\Carbon::createFromTimestamp($row['timestamp']['unix'])->format('H:i:s') }}</span>
                    </div>
                    <span class="w-1/3 px-6 py-3 text-sm font-semibold text-gray-500 uppercase">
                        By:
                    </span>
                    <div class="w-2/3 px-6 py-3 text-gray-500 ">
                        <x-link>{{ \Arr::get($row, 'generator.username', 'Unknown') }}</x-link>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
