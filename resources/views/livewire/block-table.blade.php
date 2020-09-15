<div
    :page="request()->input('page', 1)"
    wire:init="loadBlocks"
    wire:poll.16000ms="loadBlocks"
    class="relative"
>
    @if ($pagination)
    <x-loader-overlay wire:loading.class="block" wire:loading.class.remove="hidden" />
    @endif
    
    <table class="w-full divide-y divide-gray-100">
        <thead>
            <tr>
                @foreach ($headers as $key => $header)
                    <th id="{{ $key }}" class="px-4 py-2 text-xs font-semibold text-left text-gray-400 uppercase">
                        <span class="flex justify-between">
                            <span>{{ $header }}</span>

                            <a class="ml-3" href="#">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                                </svg>
                            </a>
                        </span>
                    </th>
                @endforeach
            </tr>
        </thead>

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
                            <x-link>{{ $row['generator']['username'] }}</x-link>
                        </td>
                    </tr>
                @endforeach
            @else
                <x-rows-loader :rows="$limit" :cols="count($headers)" />
            @endif
        </tbody>
    </table>
</div>
