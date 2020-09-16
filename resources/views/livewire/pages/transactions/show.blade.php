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
<div class="overflow-hidden bg-white shadow sm:rounded-md">
    <ul>
        @foreach ($rows as $name => $label)
            <li class="px-4 py-4 transition duration-150 ease-in-out transaction hover:bg-gray-50 sm:px-6">
                <span class="flex items-center justify-between text-sm font-medium leading-5 text-red-900 truncate">
                    {{ $label }}
                </span>
                <div class="flex items-center mr-6 text-sm leading-5 text-gray-500">
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
                        <span>{{ \Carbon\Carbon::createFromTimestamp($transaction['timestamp']['unix'])->format('Y-m-d') }}</span>
                        <span>{{ \Carbon\Carbon::createFromTimestamp($transaction['timestamp']['unix'])->format('H:i:s') }}</span>
                        @break

                        @case('sender')
                        <x-link title="{{ $transaction['sender'] }}" class="block truncate" href="#">{{ $transaction['sender'] }}</x-link>
                        @break

                        @case('recipient')
                        <x-link title="{{ $transaction['recipient'] }}" class="block truncate" href="#">{{ $transaction['recipient'] }}</x-link>
                        @break
                        
                        @case('blockId')
                        <x-link title="{{ $transaction['blockId'] }}" class="block truncate" href="{{ route('blocks.show', ['id' => $transaction['blockId']]) }}">{{  $transaction['blockId'] }}</x-link>
                        @break

                        @case('type')
                        {{ $transactionType }}
                        @break
                    @endswitch
                </div>
            </li>
        @endforeach
    </ul>
</div>
