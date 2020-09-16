@if(!$responsive)
<tr>
    @foreach($headers as $name => $label)
    <td class="px-6 py-4 text-sm font-medium leading-5 text-gray-900 whitespace-no-wrap">
        @switch($name)
            @case('id')
                <x-tooltip :tooltip="$row['id']">
                    <x-link title="{{ $row['id'] }}" class="block w-20 truncate" href="#">{{ $row['id'] }}</x-link>
                </x-tooltip>
                @break

            @case('height')
                {{ number_format($row['height']) }}
                @break

            @case('transactions')
                {{ number_format($row['transactions']) }}
                @break
            @case('forged')
                {{ number_format(\Arr::get($row, 'forged.total', 0) / \App\Services\Ark\ArkExplorer::AMOUNT_DECIMALS) }} Ѧ
                @break
            @case('fees')
                {{ number_format(\Arr::get($row, 'forged.fee', 0) / \App\Services\Ark\ArkExplorer::AMOUNT_DECIMALS) }} Ѧ
                @break

            @case('timestamp')
                <span>{{ \Carbon\Carbon::createFromTimestamp($row['timestamp']['unix'])->format('Y-m-d') }}</span>
                <span>{{ \Carbon\Carbon::createFromTimestamp($row['timestamp']['unix'])->format('H:i:s') }}</span>
                @break
            @case('generator')
                <x-link>{{ \Arr::get($row, 'generator.username', 'Unknown') }}</x-link>
                @break
        @endswitch
    </td>
    @endforeach
</tr>
@else
<div class="flex flex-wrap w-full md:hidden {{ $odd ? 'bg-white' : 'bg-gray-100' }}">
    @foreach($headers as $name => $label)
    <span class="w-1/3 px-6 py-3 text-sm font-semibold text-gray-500 uppercase">
        {{ $label }}
    </span>
    <div class="w-2/3 px-6 py-3 text-gray-500 ">
         @switch($name)
            @case('id')
                <x-tooltip :tooltip="$row['id']">
                    <x-link title="{{ $row['id'] }}" class="block w-20 truncate" href="#">{{ $row['id'] }}</x-link>
                </x-tooltip>
                @break

            @case('height')
                <x-link href="#">{{ number_format($row['height']) }}</x-link>
                @break

            @case('transactions')
                {{ number_format($row['transactions']) }}
                @break
            @case('forged')
                {{ number_format(\Arr::get($row, 'forged.total', 0) / \App\Services\Ark\ArkExplorer::AMOUNT_DECIMALS) }} Ѧ
                @break
            @case('fees')
                {{ number_format(\Arr::get($row, 'forged.fee', 0) / \App\Services\Ark\ArkExplorer::AMOUNT_DECIMALS) }} Ѧ
                @break

            @case('timestamp')
                <span>{{ \Carbon\Carbon::createFromTimestamp($row['timestamp']['unix'])->format('Y-m-d') }}</span>
                <span>{{ \Carbon\Carbon::createFromTimestamp($row['timestamp']['unix'])->format('H:i:s') }}</span>
                @break
            @case('generator')
                <x-link>{{ \Arr::get($row, 'generator.username', 'Unknown') }}</x-link>
                @break
        @endswitch
    </div>
    @endforeach
</div>
@endif
