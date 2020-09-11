<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use App\Http\Livewire\Form;
use Illuminate\Support\Facades\Hash;

class ResetPassword extends Form
{
    public $email = '';

    public $password = '';
    
    public $password_confirmation = '';
    
    public $token = '';

    public function mount($email = '')
    {
        $this->email = request()->email;
        $this->token = request()->token;
    }

    public function submit()
    {
        $data = $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::whereEmail($this->email)->first();

        $user->sendPasswordResetNotification($this->token);

        request()->session()->flash('status', 'Your password was successfully updated. Use the login form with your new password:');

        
        return redirect('/login');
    }

    public function updatedPasswordConfirmation()
    {
        $this->clearValidation('password');
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
