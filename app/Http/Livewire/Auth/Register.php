<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use App\Http\Livewire\Form;
use Illuminate\Support\Facades\Hash;

class Register extends Form
{
    public $name = '';
    
    public $email = '';

    public $password = '';
    
    public $password_confirmation = '';

    public function register()
    {
        $data = $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        auth()->login($user);

        return redirect('/');
    }

    public function updatedPasswordConfirmation()
    {
        $this->clearValidation('password');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
