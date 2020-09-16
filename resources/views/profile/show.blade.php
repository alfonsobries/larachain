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
        <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-0">
            @livewire('profile.update-profile-information-form')

            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('profile.update-password-form')
            </div>

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>
            @endif

            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('profile.delete-user-form')
            </div>
        </div>
    </div>
</x-guest-layout>
