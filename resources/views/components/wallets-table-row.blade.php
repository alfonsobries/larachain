@if(!$responsive)
<tr>
    @foreach($headers as $name => $label)
    <td class="px-6 py-4 text-sm font-medium leading-5 text-gray-900 whitespace-no-wrap">
        @switch($name)
            @case('address')
                <x-link title="{{ $row['address'] }}" class="block" href="{{ route('wallets.show', ['id' => $row['address']]) }}">
                    @if($username = \Arr::get($row, 'username'))
                    <span>{{ $username }} - </span>
                    @endif
                    <span>{{ $row['address'] }}</span>
                </x-link>
                @break

            @case('balance')
                {{ number_format($row['balance'] / \App\Services\Ark\ArkExplorer::AMOUNT_DECIMALS) }} Ѧ
                @break
            
            @case('nonce')
                {{ number_format($row['nonce']) }} Ѧ
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
            @case('address')
                <x-link title="{{ $row['address'] }}" class="block w-20 truncate" href="{{ route('wallets.show', ['id' => $row['address']]) }}">
                    {{ $row['address'] }}
                </x-link>
                @break

            @case('balance')
                {{ number_format($row['balance'] / \App\Services\Ark\ArkExplorer::AMOUNT_DECIMALS) }} Ѧ
                @break
            
            @case('nonce')
                {{ number_format($row['nonce']) }}
                @break

        @endswitch
        </div>
    @endforeach
</div>
@endif
