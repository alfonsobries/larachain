
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
    <x-details class="mb-4">
        @foreach ($rows as $name => $label)
        <x-details-detail :label="$label">
            @switch($name)
                @case('username')
                {{ \Arr::get($wallet, 'username', 'Unknown') }}
                @break
                @case('forged_blocks')
                {{ '@TODO' }}
                @break
                @case('voters')
                {{ '@TODO' }}
                @break
                @case('voting_for')
                {{ '@TODO' }}
                @break
            @endswitch
        </x-detail-detail>
        @endforeach
    </x-details>

    <livewire:wallet-transactions-table :wallet="$wallet" />
</div>

