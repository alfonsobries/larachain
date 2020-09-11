<form wire:submit.prevent="login" action="#" method="POST">
    @if (session('status'))
    <x-alert-success class="mb-4">
        {!! session('status') !!}
    </x-alert-success>
    @endif
    
    <x-form.input-group label="Email" for="email" :error="$errors->first('email')">
        <x-form.input
            wire:model="email"
            type="email"
            name="email"
            id="email"
            required
            :variant="$errors->has('email') ? 'error' : null"
        />
    </x-form.input-group>
    
    <x-form.input-group label="Password" for="password" :error="$errors->first('password')">
        <x-form.input
            wire:model="password"
            type="password"
            name="password"
            id="password"
            required
            :variant="$errors->has('password') ? 'error' : null"
        />
    </x-form.input-group>


    <div class="flex items-center justify-end space-x-4">
        @if (Route::has('password.request'))
            <x-link href="{{ route('password.request') }}" class="text-sm">
                {{ __('Forgot your password?') }}
            </x-link>
        @endif

        <x-button type="submit">
            Login
        </x-button>
    </div>
</form>
