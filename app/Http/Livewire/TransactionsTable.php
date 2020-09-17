<?php

namespace App\Http\Livewire;

use App\Services\Ark\ArkExplorer;

class TransactionsTable extends DynamicTable
{
    const HEADERS = [
        'id' => 'Id',
        'timestamp' => 'Time',
        'sender' => 'Sender',
        'recipient' => 'Recipient',
        'amount' => 'Amount',
        'fee' => 'Fee',
    ];

    const ORDERABLE = [
        'timestamp',
        'amount',
        'fee',
    ];

    public function mount($limit = 20, $rows = [], $headers = self::HEADERS, $orderable = self::ORDERABLE, $hidePagination = false)
    {
        parent::mount($limit, $rows, $headers, $orderable, $hidePagination);
    }

    public function getResponse()
    {
        return ArkExplorer::walletTransactions($this->getQuery());
    }

    public function getPaginationRoute()
    {
        return route('transactions');
    }

    public function render()
    {
        return view('livewire.transactions-table', [
            'pagination' => $this->getPagination()
        ]);
    }
}
