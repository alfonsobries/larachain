<?php

namespace App\Http\Livewire\Pages;

use App\Services\Ark\ArkExplorer;
use Livewire\Component;

class WalletsShow extends Component
{
    const ROWS = [
        'sender' => 'Sender',
        'recipient' => 'Recipient',
        'type' => 'Transaction type',
        'confirmations' => 'Confirmations',
        'amount' => 'Amount',
        'fee' => 'Fee',
        'timestamp' => 'Timestamp',
        'nonce' => 'Nonce',
        'blockId' => 'Block id',
    ];

    protected $wallet;
    
    public function mount()
    {
        $this->wallet = ArkExplorer::getWallet(request()->id)->json('data');
    }

    public function render()
    {
        return view('livewire.pages.wallets.show', [
            'wallet' => $this->wallet,
        ])->layout('layouts.guest');
    }
}
