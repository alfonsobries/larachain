<x-slot name="header">
    <x-header title="{{ $wallet['address'] }}">
        <x-slot name="breadcrumb">
            <x-breadcrumb :back-url="route('transactions')" :items="[
                    [
                        'url' => route('welcome'),
                        'label' => 'Home',
                    ],
                    [
                        'url' => route('wallets'),
                        'label' => 'Wallets',
                    ],
                ]" />
        </x-slot>
        <x-slot name="right">
            <div class="flex">
                <div class="flex flex-col px-4">
                    <span class="text-sm text-gray-500 uppercase">Balance</span>
                    <span class="font-semibold">{{ number_format($wallet['balance'] / \App\Services\Ark\ArkExplorer::AMOUNT_DECIMALS) }}Ѧ</span>
                </div>
                @if($username = \Arr::get($wallet, 'username'))
                <div class="flex flex-col px-4 border-l">
                    <span class="text-sm text-gray-500 uppercase">Address</span>
                    <span class="font-semibold">{{ $username }}</span>
                </div>
                @endif
            </div>
        </x-slot>
    </x-header>
</x-slot>

<div class="overflow-hidden bg-white shadow sm:rounded-md">
    <livewire:wallet-transactions-table>
</div>
{{-- 
    <ul>
        @foreach ($rows as $name => $label)
            <li class="px-4 py-4 transition duration-150 ease-in-out transaction hover:bg-gray-50 sm:px-6">
                <span class="flex items-center justify-between text-sm font-medium leading-5 text-red-900 truncate">
                    {{ $label }}
                </span>
                <div class="flex flex-col mr-6 text-sm leading-5 text-gray-500">
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
                    <x-link title="{{ $transaction['sender'] }}" class="block truncate"
                        href="{{ route('wallets.show', ['id' => $transaction['sender']]) }}">
                        {{ $sender['username'] }}
                    </x-link>
                    {{ $transaction['sender'] }}
                    @break

                    @case('recipient')
                    <x-link title="{{ $transaction['recipient'] }}" class="block truncate"
                        href="{{ route('wallets.show', ['id' => $transaction['recipient']]) }}">
                        {{ $recipient['username'] }}
                    </x-link>
                    {{ $transaction['recipient'] }}
                    @break

                    @case('blockId')
                    <x-link title="{{ $transaction['blockId'] }}" class="block truncate"
                        href="{{ route('blocks.show', ['id' => $transaction['blockId']]) }}">
                        {{ $transaction['blockId'] }}</x-link>
                    @break

                    @case('type')
                    {{ $transactionType }}
                    @break
                    @endswitch
                </div>
            </li>
        @endforeach
    </ul>
</div> --}}
