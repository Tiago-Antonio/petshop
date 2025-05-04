<?php

namespace App\Http\Livewire\Login;

use Livewire\Component;
use Illuminate\Support\Facades\Auth; 

class Login extends Component
{
    public $email;
    public $password;

    public function formularioLogin()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            session()->regenerate(); 
            return redirect()->intended('/'); 
        }

        session()->flash('error', 'E-mail ou senha inválidos.');
    }
    public function render()
    {
        return view('livewire.login.login');
    }
}
