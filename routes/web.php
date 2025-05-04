<?php

use Illuminate\Support\Facades\Route;


Route::get('/header', \App\Http\Livewire\Components\Header\Header::class)->name('header');
Route::get('/', \App\Http\Livewire\Home\Home::class)->name('home');
Route::get('/funcionarios', \App\Http\Livewire\Funcionarios\ModuloFuncionarios::class)->name('funcionarios');

Route::get('/login', \App\Http\Livewire\Login\Login::class)->middleware('guest')->name('login');



