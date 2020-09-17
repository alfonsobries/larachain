<?php

namespace App\Http\Livewire;

use App\Services\Ark\ArkExplorer;

class WalletTransactionsTable extends TransactionsTable
{
    public $walletId;
    public $filter;
    public $availableFilters;
    public $wallet;
    
    const FILTER_ALL = '';
    const FILTER_SENT = '/sent';
    const FILTER_RECEIVED = '/received';

    public function mount($limit = 20, $rows = [], $headers = self::HEADERS, $orderable = self::ORDERABLE, $hidePagination = false)
    {
        $this->walletId = request()->id;

        $this->availableFilters = [
            self::FILTER_ALL => 'All',
            self::FILTER_SENT => 'Sent',
            self::FILTER_RECEIVED => 'Received',
        ];

        $this->filter = self::FILTER_ALL;

        parent::mount($limit, $rows, $headers, $orderable, $hidePagination);
    }


    public function getResponse()
    {
        return ArkExplorer::getWalletTransactions($this->walletId, $this->getQuery(), $this->filter);
    }

    public function setFilter($newFilter)
    {
        $this->filter = $newFilter;

        $this->loadData();
    }

    public function getPaginationRoute()
    {
        return route('wallets.show', ['id' => $this->walletId]);
    }

    public function render()
    {
        return view('livewire.wallet-transactions-table', [
            'pagination' => $this->getPagination()
        ]);
    }
}
