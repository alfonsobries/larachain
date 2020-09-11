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
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</x-empty-layout>
