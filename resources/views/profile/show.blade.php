<x-guest-layout>
    <x-slot name="header">
        <x-header title="Profile">
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

    <div>
        <div class="p-10 mx-auto rounded max-w-7xl sm:px-6 dark:bg-gray-200 dark:mt-10">
            @livewire('profile.update-profile-information-form')

            <hr class="my-4 border-t" />
            
            
            <div class="mt-10 sm:mt-0">
                @livewire('profile.update-password-form')
            </div>
    </div>
</x-guest-layout>
