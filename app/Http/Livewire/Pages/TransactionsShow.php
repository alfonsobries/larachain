<?php

namespace App\Http\Livewire\Pages;

use App\Services\Ark\ArkExplorer;
use Livewire\Component;

class TransactionsShow extends Component
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

    protected $transaction;
    protected $sender;
    protected $recipient;
    public $actions;
    public $transactionType;
    public $rows;
    
    public function mount()
    {
        $transaction = ArkExplorer::getTransaction(request()->id)->json('data');

        $this->transactionType = $this->getTransactionType($transaction);
        $this->sender = $this->getWallet($transaction['sender']);
        $this->recipient = $this->getWallet($transaction['recipient']);
        $this->rows = self::ROWS;
        $this->transaction = $transaction;
    }

    protected function getTransactionType($transaction)
    {
        $transactionTypes = ArkExplorer::getTransactionTypes()->json('data');
        return array_flip($transactionTypes[$transaction['typeGroup']])[$transaction['type']];
    }

    protected function getWallet($id)
    {
        return ArkExplorer::getWallet($id)->json('data');
    }

    public function render()
    {
        return view('livewire.pages.transactions.show', [
            'transaction' => $this->transaction,
            'sender' => $this->sender,
            'recipient' => $this->recipient,
        ])->layout('layouts.guest');
    }
}
