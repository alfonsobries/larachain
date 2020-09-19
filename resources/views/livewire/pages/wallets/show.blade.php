
<x-slot name="header">
    <x-header title="{{ $wallet->address }}">
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
                        class="font-semibold text-gray-800 dark:text-gray-200">{{ number_format($wallet->balance / \App\Services\Ark\ArkExplorer::AMOUNT_DECIMALS) }}Ѧ</span>
                </div>
                @if ($username = $wallet->username)
                    <div class="flex flex-col px-4 border-l">
                        <span class="text-sm text-gray-500 uppercase">Address</span>
                        <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $username }}</span>
                    </div>
                @endif

                <livewire:save-wallet-button />
            </div>
        </x-slot>
    </x-header>
</x-slot>

<div wire:poll.5000ms="refreshWallet">
    <x-details class="mb-4">
        @foreach ($rows as $name => $label)
        <x-details-detail :label="$label">
            @switch($name)
                @case('username')
                {{ $wallet->username ?: 'Unknown' }}
                @break
                @case('rank')
                    @if($wallet->rank != null)
                        {{ number_format($wallet->rank) }}
                    @else
                        -
                    @endif
                @break
                @case('forged_blocks')
                    @if($wallet->produced_blocks != null)
                        {{ number_format($wallet->produced_blocks) }}
                    @else
                        -
                    @endif
                @break
                @case('voters')
                {{ number_format($wallet->total_votes) }}
                @break
                @case('voting_for')
                    @if(!$wallet->voting_for_address)
                    NA
                    @else
                    <x-link title="{{ $wallet->voting_for_address }}" class="block truncate" href="{{ route('wallets.show', ['id' => $wallet->voting_for_address]) }}">
                        {{ $wallet->voting_for_username ?: 'Unknown' }}
                    </x-link>
                    @endif
                @break
            @endswitch
        </x-detail-detail>
        @endforeach
    </x-details>

    <livewire:wallet-transactions-table :wallet="$wallet" />
</div>

