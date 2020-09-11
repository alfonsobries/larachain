<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use App\Http\Livewire\Form;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPassword extends Form
{
    use SendsPasswordResetEmails;
    
    public $email = '';
    
    public $success = false;

    public function submit()
    {
        $this->validate([
            'email' => 'required|email',
        ]);
        
        $user = User::whereEmail($this->email)->first();

        if ($user) {
            $this->broker()->sendResetLink(
                ['email' => $user->email]
            );
        }

        // Sending success always so I dont give information to the user about
        // the existence of the the email in the database
        $message = sprintf(
            'We just sent you a password reset link that will allow you to reset your password, please check your inbox. <br /> <a class="underline" href="%s">Go back to login page</a>',
            route('login')
        );

        $this->success = true;
        
        request()->session()->flash('status', $message);
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }


    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
