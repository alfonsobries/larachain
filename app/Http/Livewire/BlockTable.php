<?php

namespace App\Http\Livewire;

use App\Services\Ark\ArkExplorer;

class BlockTable extends DynamicTable
{
    const HEADERS = [
        'id' => 'Id',
        'height' => 'Height',
        'timestamp' => 'Time',
        'transactions' => 'Transactions',
        'generator' => 'By',
        'forged' => 'Forged',
        'fees' => 'Fees',
    ];

    const ORDERABLE = [
        'height',
        'timestamp',
    ];

    public function mount($limit = 20, $rows = [], $headers = self::HEADERS, $orderable = self::ORDERABLE, $hidePagination = false)
    {
        parent::mount($limit, $rows, $headers, $orderable, $hidePagination);
    }

    public function getResponse()
    {
        return ArkExplorer::blocks($this->getQuery());
    }

    public function getPaginationRoute()
    {
        return route('blocks');
    }

    public function render()
    {
        return view('livewire.block-table', [
            'pagination' => $this->getPagination()
        ]);
    }
}
