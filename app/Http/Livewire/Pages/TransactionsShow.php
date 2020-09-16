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
    public $actions;
    public $transactionType;
    public $rows;
    
    public function mount()
    {
        $transaction = ArkExplorer::getTransaction(request()->id)->json('data');
        
        $this->transaction = $transaction;
        $this->transactionType = $this->getTransactionType($transaction);
        $this->rows = self::ROWS;
    }

    protected function getTransactionType($transaction)
    {
        $transactionTypes = ArkExplorer::getTransactionTypes()->json('data');
        return array_flip($transactionTypes[$transaction['typeGroup']])[$transaction['type']];
    }

    public function render()
    {
        return view('livewire.pages.transactions.show', [
            'transaction' => $this->transaction
        ])->layout('layouts.guest');
    }
}
