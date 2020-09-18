<x-slot name="header">
    <x-header title="{{ $block['id'] }}" :actions="$actions">
        <x-slot name="breadcrumb">
            <x-breadcrumb
                :back-url="route('blocks')"
                :items="[
                    [
                        'url' => route('welcome'),
                        'label' => 'Home',
                    ],
                    [
                        'url' => route('blocks'),
                        'label' => 'Blocks',
                    ],
                ]"
            />
        </x-slot>
    </x-header>
</x-slot>

<x-details>
    @foreach ($rows as $name => $label)
    <x-details-detail :label="$label">
        @switch($name)
            @case('transactions')
            @case('confirmations')
            @case('height')
            {{ number_format($block[$name]) }}
            @break

            @case('reward')
            @case('fee')
            @case('amount')
            @case('total')
            {{ number_format(\Arr::get($block, 'forged.' . $name, 0) / \App\Services\Ark\ArkExplorer::AMOUNT_DECIMALS) }}
            Ѧ
            @break

            @case('timestamp')
            <span>{{ \Carbon\Carbon::createFromTimestamp($block['timestamp']['unix'])->format('Y-m-d') }}</span>
            <span>{{ \Carbon\Carbon::createFromTimestamp($block['timestamp']['unix'])->format('H:i:s') }}</span>
            @break

            @case('generator')
            <x-link href="{{ route('wallets.show', ['id' => \Arr::get($block, 'generator.address')]) }}">{{ \Arr::get($block, 'generator.username', 'Unknown') }}</x-link>
            @break                
        @endswitch
    </x-detail-detail>
    @endforeach
</x-details>

