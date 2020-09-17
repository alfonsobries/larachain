<?php

namespace App\Http\Livewire;

use App\Services\Ark\ArkExplorer;

class WalletsTable extends DynamicTable
{
    const HEADERS = [
        'address' => 'Address',
        'balance' => 'Balance',
        'nonce' => 'Nonce',
    ];

    const ORDERABLE = [
        'balance',
        'nonce',
    ];

    public function mount($limit = 20, $rows = [], $headers = self::HEADERS, $orderable = self::ORDERABLE, $hidePagination = false)
    {
        parent::mount($limit, $rows, $headers, $orderable, $hidePagination);
    }

    public function getResponse()
    {
        return ArkExplorer::wallets($this->getQuery());
    }

    public function getPaginationRoute()
    {
        return route('wallets');
    }

    public function render()
    {
        return view('livewire.wallets-table', [
            'pagination' => $this->getPagination()
        ]);
    }
}
