<x-empty-layout>
    <div class="flex flex-col items-center justify-center h-screen max-w-md py-10 mx-auto space-y-8">
        
        <x-link href="{{ route('welcome') }}" class="flex items-center mx-4 space-x-2 md:absolute md:top-5 md:left-5">
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            
            <span>Back to home</span>

            {{ \Route::is('/login')  }} 
        </x-link>
        
        <x-logo class="mx-auto" />
        
        <div>
            <x-title class="mb-2 text-center">
                Sign in to your account
            </x-title>

            <p class="text-center">
                or 
                <x-link href="{{ route('register') }}">
                    haven't signed up yet?
                </x-link>
            </p>
        </div>

        <x-card>
            <livewire:auth.login />
        </x-card>
    </div>
</x-empty-layout>
