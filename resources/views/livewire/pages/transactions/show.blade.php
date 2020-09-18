<x-slot name="header">
    <x-header title="{{ $transaction['id'] }}">
        <x-slot name="breadcrumb">
            <x-breadcrumb :back-url="route('transactions')" :items="[
                    [
                        'url' => route('welcome'),
                        'label' => 'Home',
                    ],
                    [
                        'url' => route('transactions'),
                        'label' => 'Transactions',
                    ],
                ]" />
        </x-slot>
    </x-header>
</x-slot>

<x-details>
    @foreach ($rows as $name => $label)
    <x-details-detail :label="$label">
        @switch($name)
            @case('confirmations')
            {{ number_format($transaction[$name]) }}
            @break

            @case('fee')
            @case('amount')
            @case('nonce')
            {{ number_format($transaction[$name] / \App\Services\Ark\ArkExplorer::AMOUNT_DECIMALS) }} Ѧ
            @break

            @case('timestamp')
            {{ \Carbon\Carbon::createFromTimestamp($transaction['timestamp']['unix'])->format('Y-m-d H:i:s') }}
            @break

            @case('sender')
            <x-link title="{{ $transaction['sender'] }}" class="block truncate" href="{{ route('wallets.show', ['id' => $transaction['sender']]) }}">
                {{ $sender['username'] }}
            </x-link>
            {{ $transaction['sender'] }}
            @break

            @case('recipient')
            <x-link title="{{ $transaction['recipient'] }}" class="block truncate" href="{{ route('wallets.show', ['id' => $transaction['recipient']]) }}">
                {{ $recipient['username'] }}
            </x-link>
            {{ $transaction['recipient'] }}
            @break
            
            @case('blockId')
            <x-link title="{{ $transaction['blockId'] }}" class="block truncate" href="{{ route('blocks.show', ['id' => $transaction['blockId']]) }}">{{  $transaction['blockId'] }}</x-link>
            @break

            @case('type')
            {{ $transactionType }}
            @break
        @endswitch
    </x-detail-detail>
    @endforeach
</x-details>
