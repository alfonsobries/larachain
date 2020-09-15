<?php

namespace App\Http\Livewire;

class TransactionsTable extends DynamicTable
{
    public function mount($limit = 6, $page = 1)
    {
        parent::mount($limit, $page);

        $this->headers = [
            'id' => 'Id',
            'timestamp' => 'Time',
            'sender' => 'Sender',
            'amount' => 'Amount',
        ];
        
        $this->orderable = [
            'timestamp',
        ];
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
