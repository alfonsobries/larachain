<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SaveWalletButton extends Component
{
    public $walletId;
    public $isSaved;

    public function mount($walletId)
    {
        $this->walletId = $walletId;
        $this->isSaved = auth()->user()->wallets()->where('id', $this->walletId)->exists();
    }

    public function saveWallet()
    {
        $user = auth()->user();

        if ($this->isSaved) {
            $user->wallets()->detach($this->walletId);
            $this->isSaved = false;
        } else {
            $user->wallets()->attach($this->walletId);
            $this->isSaved = true;
        }

        session()->flash('walletSaved');
    }

    public function render()
    {
        return view('livewire.save-wallet-button');
    }
}
