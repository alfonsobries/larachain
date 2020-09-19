<?php

namespace App\Http\Livewire\Pages;

use App\Models\Wallet;
use App\Services\Ark\ArkExplorer;
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
    public $walletId;

    public function mount()
    {
        $this->wallet = Wallet::updateOrCreateFromApi(request()->id);
        $this->walletId = $this->wallet->id;

        $this->rows = self::ROWS;
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
