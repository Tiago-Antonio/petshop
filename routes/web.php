<?php

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Errors\Error404;
use Illuminate\Support\Facades\Auth;
// -------------------- Rota do gráficos pizza de fornecedores --------------------
use App\Http\Controllers\SupplierController;
use App\Models\User;

Route::middleware('auth')->group(function () {
    Route::get('/', \App\Http\Livewire\Home\Home::class)->name('home');
    Route::get('/header', \App\Http\Livewire\Components\Header\Header::class)->name('header');
    Route::get('/clientes', \App\Http\Livewire\Clientes\Clientes::class)->name('clientes');
    Route::get('/produtos', \App\Http\Livewire\Produtos\Produtos::class)->name('produtos');
    Route::get('/produtos/categoria', \App\Http\Livewire\Produtos\CategoriasProdutos::class)->name('produtosCategoria');
    Route::get('/supplier', \App\Http\Livewire\Supplier\SupplierModule::class)->name('suppliers'); 
    Route::get('/vendas', \App\Http\Livewire\Vendas\Vendas::class)->name('vendas');
});


Route::middleware(['admin'])->group(function () {
    Route::get('/funcionarios', \App\Http\Livewire\Funcionarios\ModuloFuncionarios::class)->name('funcionarios');
});

// Login
Route::post('/logout', function () {Auth::logout();request()->session()->invalidate();request()->session()->regenerateToken(); return redirect('/login');})->name('logout');
Route::get('/login', \App\Http\Livewire\Login\Login::class)->middleware('guest')->name('login');

// Erro
Route::fallback(Error404::class);

//Autenticação
Route::get('/auth/github/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('loginSocialite');
 
// Em routes/web.php
Route::get('/auth/github/callback', function () {
    try {
        $githubUser = Socialite::driver('github')->stateless()->user();

        $user = User::where('email', $githubUser->email)->first();


        if (!$user) {
            return redirect('/login')->with('error', 'Nenhuma conta encontrada com este e-mail.');
        }

         $user->update([
            'github_id' => $githubUser->id,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);

        // if ($existingUser) {
        //     // Atualiza os dados do GitHub no usuário existente
        //     $existingUser->update([
        //         'github_id' => $githubUser->id,
        //         'github_token' => $githubUser->token,
        //         'github_refresh_token' => $githubUser->refreshToken,
        //     ]);
        //     $user = $existingUser;
        // } else {
        //     // Cria um novo usuário
        //     $user = User::create([
        //         'github_id' => $githubUser->id,
        //         'name' => $githubUser->name ?? $githubUser->nickname ?? 'Usuário GitHub',
        //         'email' => $githubUser->email,
        //         'password' => bcrypt(Str::random(32)), //Cria uma senha aleatória
        //         'github_token' => $githubUser->token,
        //         'github_refresh_token' => $githubUser->refreshToken,
        //     ]);
        // }

        Auth::login($user);
        return redirect('/')->with('success', 'Login realizado com sucesso!');

    } catch (\Exception $e) {
        return redirect('/login')->with('error', 'Erro ao autenticar: ' . $e->getMessage());
    }
});


