<?php

namespace App\Http\Livewire;

class BlockTable extends DynamicTable
{
    public function mount($limit = 6, $page = 1, $rows = [])
    {
        $this->headers = [
            'id' => 'Id',
            'height' => 'Height',
            'timestamp' => 'Time',
            'generator' => 'By',
        ];
        
        $this->orderable = [
            'height',
            'timestamp',
        ];

        parent::mount($limit, $page, $rows);
    }

    protected function getApiUrl()
    {
        $apiUrl = sprintf('%s/blocks', config('services.ark.endpoint'));
        $query = $this->getQuery();

        if (count($query)) {
            return $apiUrl . '?' . http_build_query($query);
        }

        return $apiUrl;
    }

    public function render()
    {
        return view('livewire.block-table', [
            'pagination' => $this->getPagination()
        ]);
    }
}
