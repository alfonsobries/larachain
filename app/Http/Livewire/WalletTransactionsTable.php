<?php

namespace App\Http\Livewire;

use App\Services\Ark\ArkExplorer;

class WalletTransactionsTable extends TransactionsTable
{
    public $walletId;

    public function mount($limit = 20, $rows = [], $headers = self::HEADERS, $orderable = self::ORDERABLE, $hidePagination = false)
    {
        $this->walletId = request()->id;

        parent::mount($limit, $rows, $headers, $orderable, $hidePagination);
    }

    public function getResponse()
    {
        return ArkExplorer::getWalletTransactions($this->walletId, $this->getQuery());
    }

    public function getPaginationRoute()
    {
        return route('wallets.show', ['id' => $this->walletId]);
    }
}
