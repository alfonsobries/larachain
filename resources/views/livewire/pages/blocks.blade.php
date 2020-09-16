<x-slot name="header">
    <x-header title="Blocks">
        <x-slot name="breadcrumb">
            <x-breadcrumb
                :back-url="route('welcome')"
                :items="[
                    [
                        'url' => route('welcome'),
                        'label' => 'Home',
                    ],
                ]"
            />
        </x-slot>
    </x-header>
</x-slot>

<div class="w-full bg-white shadow">
    <livewire:block-table />
</div>
