<div>
    <form wire:submit.prevent="submit" action="#" method="POST">
        <x-form.input-group label="Email" for="email" :error="$errors->first('email')">
            <x-form.input
                wire:model="email"
                type="email"
                name="email"
                id="email"
                required
                autofocus
                :variant="$errors->has('email') ? 'error' : null"
            />
        </x-form.input-group>
        
        <x-form.input-group label="Password" for="password" :error="$errors->first('password')" autocomplete="new-password">
            <x-form.input
                wire:model="password"
                type="password"
                name="password"
                id="password"
                required
                :variant="$errors->has('password') ? 'error' : null"
            />
        </x-form.input-group>

        <x-form.input-group label="Confirm your password" for="password_confirmation" :error="$errors->first('password_confirmation')" autocomplete="new-password">
            <x-form.input
                wire:model="password_confirmation"
                type="password"
                name="password_confirmation"
                id="password_confirmation"
                required
                :variant="$errors->has('password_confirmation') ? 'error' : null"
            />
        </x-form.input-group>

   
        <div class="flex items-center justify-end space-x-4">
            <x-button type="submit">
                {{ __('Reset Password') }}
            </x-button>
        </div>
    </form>
</div>
