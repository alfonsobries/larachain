@if(!$responsive)
<tr>
    @foreach($headers as $name => $label)
    <td class="px-6 py-4 text-sm font-medium leading-5 text-gray-900 whitespace-no-wrap">
        @switch($name)
            @case('id')
                <x-link title="{{ $row['id'] }}" class="block w-20 truncate" href="{{ route('transactions.show', ['id' => $row['id']]) }}">
                    {{ $row['id'] }}
                </x-link>
                @break

            @case('timestamp')
                <span>{{ \Carbon\Carbon::createFromTimestamp($row['timestamp']['unix'])->format('Y-m-d') }}</span>
                <span>{{ \Carbon\Carbon::createFromTimestamp($row['timestamp']['unix'])->format('H:i:s') }}</span>
                @break
            @case('sender')
                <x-tooltip :tooltip="$row['sender']">
                    <x-link title="{{ $row['sender'] }}" class="block w-20 truncate" href="{{ route('wallets.show', ['id' => $row['sender']]) }}">{{ $row['sender'] }}</x-link>
                </x-tooltip>
                @break
            @case('recipient')
                <x-tooltip :tooltip="$row['recipient']">
                    <x-link title="{{ $row['recipient'] }}" class="block w-20 truncate" href="{{ route('wallets.show', ['id' => $row['recipient']]) }}">{{ $row['recipient'] }}</x-link>
                </x-tooltip>
                @break
            @case('amount')
                {{ number_format($row['amount'] / \App\Services\Ark\ArkExplorer::AMOUNT_DECIMALS) }} Ѧ
                @break
            
            @case('fee')
                {{ number_format($row['fee'] / \App\Services\Ark\ArkExplorer::AMOUNT_DECIMALS) }} Ѧ
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
                    <x-link title="{{ $row['id'] }}" class="block w-20 truncate" href="{{ route('transactions.show', ['id' => $row['id']]) }}">
                        {{ $row['id'] }}
                    </x-link>
                </x-tooltip>
                @break

            @case('timestamp')
                <span>{{ \Carbon\Carbon::createFromTimestamp($row['timestamp']['unix'])->format('Y-m-d') }}</span>
                <span>{{ \Carbon\Carbon::createFromTimestamp($row['timestamp']['unix'])->format('H:i:s') }}</span>
                @break
            @case('sender')
                <x-tooltip :tooltip="$row['sender']">
                    <x-link title="{{ $row['sender'] }}" class="block w-20 truncate" href="{{ route('wallets.show', ['id' => $row['sender']]) }}">{{ $row['sender'] }}</x-link>
                </x-tooltip>
                @break
            @case('recipient')
                <x-tooltip :tooltip="$row['recipient']">
                    <x-link title="{{ $row['recipient'] }}" class="block w-20 truncate" href="{{ route('wallets.show', ['id' => $row['recipient']]) }}">{{ $row['recipient'] }}</x-link>
                </x-tooltip>
                @break
            @case('amount')
                {{ number_format($row['amount'] / \App\Services\Ark\ArkExplorer::AMOUNT_DECIMALS) }} Ѧ
                @break
            
            @case('fee')
                {{ number_format($row['fee'] / \App\Services\Ark\ArkExplorer::AMOUNT_DECIMALS) }} Ѧ
                @break

        @endswitch
        </div>
    @endforeach
</div>
@endif
