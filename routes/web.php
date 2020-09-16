<?php

use App\Http\Livewire\Pages\Blocks;
use App\Http\Livewire\Pages\Welcome;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Pages\BlocksShow;
use App\Http\Livewire\Pages\Transactions;
use App\Http\Livewire\Pages\TransactionsShow;

Route::get('/', Welcome::class)->name('welcome');

Route::get('/transactions', Transactions::class)->name('transactions');
Route::get('/transactions/{id}', TransactionsShow::class)->name('transactions.show');

Route::get('/blocks', Blocks::class)->name('blocks');
Route::get('/blocks/{id}', BlocksShow::class)->name('blocks.show');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
