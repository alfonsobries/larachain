<?php

namespace App\Http\Livewire;

use App\Services\Ark\ArkExplorer;

class BlockTable extends DynamicTable
{
    const HEADERS = [
        'id' => 'Id',
        'height' => 'Height',
        'timestamp' => 'Time',
        'generator' => 'By',
    ];

    const ORDERABLE = [
        'height',
            'timestamp',
    ];

    public function mount($limit = 6, $page = 1, $rows = [], $headers = self::HEADERS, $orderable = self::ORDERABLE)
    {
        parent::mount($limit, $page, $rows, $headers, $orderable);
    }

    public function getResponse()
    {
        return ArkExplorer::blocks($this->getQuery());
    }

    public function render()
    {
        return view('livewire.block-table', [
            'pagination' => $this->getPagination()
        ]);
    }
}
