
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
                    <span
                        class="font-semibold">{{ number_format($wallet['balance'] / \App\Services\Ark\ArkExplorer::AMOUNT_DECIMALS) }}Ѧ</span>
                </div>
                @if ($username = \Arr::get($wallet, 'username'))
                    <div class="flex flex-col px-4 border-l">
                        <span class="text-sm text-gray-500 uppercase">Address</span>
                        <span class="font-semibold">{{ $username }}</span>
                    </div>
                @endif
            </div>
        </x-slot>
    </x-header>
</x-slot>

<div>
    <livewire:wallet-transactions-table :wallet="$wallet" />
</div>

