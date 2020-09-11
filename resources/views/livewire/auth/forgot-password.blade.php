<form wire:submit.prevent="submit" action="#" method="POST">
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
            :disabled="$success"
            :variant="$errors->has('email') ? 'error' : null"
        />
    </x-form.input-group>
    
    @if($success)
    <x-button disabled>
        {{ __('Email Password Reset Link') }}
    </x-button>
    @else
    <x-button type="submit">
        {{ __('Email Password Reset Link') }}
    </x-button>
    @endif
    
</form>
