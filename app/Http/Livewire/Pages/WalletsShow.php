<?php

namespace App\Http\Livewire\Pages;

use App\Exceptions\WalletNotFoundException;
use App\Models\Wallet;
use Livewire\Component;

class WalletsShow extends Component
{
    const ROWS = [
        'username' => 'Username',
        'forged_blocks' => 'Forged Blocks',
        'rank' => 'Rank',
        'voters' => 'Voters',
        'voting_for' => 'Voting For',
    ];

    protected $wallet;
    public $rows;
    public $walletId = null;

    public function mount()
    {
        $this->rows = self::ROWS;
        
        try {
            $this->wallet = Wallet::updateOrCreateFromApi(request()->id, get_current_api());
        } catch (WalletNotFoundException $e) {
            return;
        }
        
        $this->walletId = $this->wallet->id;
    }

    public function refreshWallet()
    {
        $this->wallet = Wallet::find($this->walletId)->refreshFromApi();
    }

    public function render()
    {
        return view('livewire.pages.wallets.show', [
            'wallet' => $this->wallet,
        ])->layout('layouts.guest');
    }
}
