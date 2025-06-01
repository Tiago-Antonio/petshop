<?php

namespace App\Http\Livewire\Login;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth; 

class Login extends Component
{
    public $email;
    public $password;

      protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function formularioLogin()
    {
        $this->validate();

        $user = User::where('email', $this->email)->first();

        if ($user && !$user->active) {
            session()->flash('error', 'Sua conta está inativa. Entre em contato com o suporte.');
            return;
        }

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();
            return redirect()->intended('/');
        }

        session()->flash('error', 'Credenciais inválidas. Verifique seu e-mail e senha.');
    }


    public function render()
    {
        return view('livewire.login.login');
    }
}
