
@if($wallet)
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

                @if(auth()->user())
                <livewire:save-wallet-button :wallet-id="$wallet->id" />
                @endif
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
@endif

<div class="flex flex-col items-center text-center">
    <svg class="w-20 h-20 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    <h3 class="text-3xl font-semibold text-center">Wallet not found!</h3>
    <p class="text-center">Are you using the correct API?</p>
</div>