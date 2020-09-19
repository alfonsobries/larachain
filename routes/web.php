<?php

use App\Http\Controllers\WalletsController;
use App\Http\Livewire\Pages\Blocks;
use App\Http\Livewire\Pages\Wallets;
use App\Http\Livewire\Pages\Welcome;
use App\View\Components\WalletsMine;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Pages\BlocksShow;
use App\Http\Livewire\Pages\WalletsShow;
use App\Http\Livewire\Pages\Transactions;
use App\Http\Livewire\Pages\TransactionsShow;

Route::get('/', Welcome::class)->name('welcome');

Route::get('/transactions', Transactions::class)->name('transactions');
Route::get('/transactions/{id}', TransactionsShow::class)->name('transactions.show');

Route::get('/blocks', Blocks::class)->name('blocks');
Route::get('/blocks/{id}', BlocksShow::class)->name('blocks.show');

Route::get('/wallets', Wallets::class)->name('wallets');
Route::get('/wallets/mine', [WalletsController::class, 'mine'])->name('wallets.mine');
Route::get('/wallets/{id}', WalletsShow::class)->name('wallets.show');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
