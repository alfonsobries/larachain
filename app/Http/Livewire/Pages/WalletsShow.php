<?php

namespace App\Http\Livewire\Pages;

use App\Services\Ark\ArkExplorer;
use Livewire\Component;

class WalletsShow extends Component
{
    const ROWS = [
        'username' => 'Username',
        'forged_blocks' => 'Forged Blocks',
        'voters' => 'Voters',
        'voting_for' => 'Voting For',
    ];

    protected $wallet;
    public $rows;

    public function mount()
    {
        $this->wallet = ArkExplorer::getWallet(request()->id)->json('data');

        $this->rows = self::ROWS;
    }

    public function render()
    {
        return view('livewire.pages.wallets.show', [
            'wallet' => $this->wallet,
        ])->layout('layouts.guest');
    }
}
