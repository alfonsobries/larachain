<x-empty-layout>
    <div class="min-h-screen bg-gray-100">

        <x-layout.main-navigation />

        <div>
            @isset($header)
                <header class="py-10 bg-white shadow-sm">
                    {{ $header }}
                </header>
            @endisset
            <main>
                <x-container>
                    {{ $slot }}
                </x-container>
            </main>
        </div>
    </div>
</x-empty-layout>
