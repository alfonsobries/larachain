<x-slot name="header">
    <x-header title="{{ $block['id'] }}" :actions="$actions">
        <x-slot name="breadcrumb">
            <x-breadcrumb :back-url="route('blocks')" :items="[
                    [
                        'url' => route('welcome'),
                        'label' => 'Home',
                    ],
                    [
                        'url' => route('blocks'),
                        'label' => 'Blocks',
                    ],
                ]" />
        </x-slot>
    </x-header>
</x-slot>
<div class="overflow-hidden bg-white shadow sm:rounded-md">
    <ul>
        @foreach ($rows as $name => $label)
            <li class="block px-4 py-4 transition duration-150 ease-in-out hover:bg-gray-50 sm:px-6">
                <span class="flex items-center justify-between text-sm font-medium leading-5 text-red-900 truncate">
                    {{ $label }}
                </span>
                <div class="flex items-center mr-6 text-sm leading-5 text-gray-500">
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
                        <x-link>{{ \Arr::get($block, 'generator.username', 'Unknown') }}</x-link>
                        @break                
                    @endswitch
                </div>
            </li>
        @endforeach
    </ul>
</div>
