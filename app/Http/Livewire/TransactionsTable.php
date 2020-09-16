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
    ];

    public function mount($limit = 6, $page = 1, $rows = [], $headers = self::HEADERS, $orderable = self::ORDERABLE)
    {
        parent::mount($limit, $page, $rows, $headers, $orderable);
    }

    public function getResponse()
    {
        return ArkExplorer::transactions($this->getQuery());
    }

    protected function getApiUrl()
    {
        $apiUrl = sprintf('%s/transactions', config('services.ark.endpoint'));
        $query = $this->getQuery();

        if (count($query)) {
            return $apiUrl . '?' . http_build_query($query);
        }

        return $apiUrl;
    }

    public function render()
    {
        return view('livewire.transactions-table', [
            'pagination' => $this->getPagination()
        ]);
    }
}
