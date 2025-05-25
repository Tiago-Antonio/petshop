<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Errors\Error404;
use Illuminate\Support\Facades\Auth;
// -------------------- Rota do gráficos pizza de fornecedores --------------------
use App\Http\Controllers\SupplierController;

Route::middleware('auth')->group(function () {
    Route::get('/', \App\Http\Livewire\Home\Home::class)->name('home');
    Route::get('/header', \App\Http\Livewire\Components\Header\Header::class)->name('header');
    Route::get('/clientes', \App\Http\Livewire\Clientes\Clientes::class)->name('clientes');
    Route::get('/produtos', \App\Http\Livewire\Produtos\Produtos::class)->name('produtos');
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

// Retorna os 5 fornecedores com mais entregas
Route::get('/labelDataGraphicPie', [SupplierController::class, 'labelDataGraphicPie']);



