<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::get('/', \App\Http\Livewire\Home\Home::class)->name('home');
    Route::get('/header', \App\Http\Livewire\Components\Header\Header::class)->name('header');
    Route::get('/funcionarios', \App\Http\Livewire\Funcionarios\ModuloFuncionarios::class)->name('funcionarios');

});

// Login
Route::post('/logout', function () {Auth::logout();request()->session()->invalidate();request()->session()->regenerateToken(); return redirect('/login');})->name('logout');
Route::get('/login', \App\Http\Livewire\Login\Login::class)->middleware('guest')->name('login');


// Erro
Route::get('/{any}', \App\Http\Livewire\Errors\Error404::class)->where('any', '.*');



