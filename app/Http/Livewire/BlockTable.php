<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class BlockTable extends Component
{
    protected $response = null;

    public $headers = [
        'blockId' => 'Id',
        'height' => 'Height',
        'timestamp' => 'Time',
        'generator' => 'By',
    ];

    public $orderable = [
        'height' => 'Height',
        'timestamp' => 'Time',
    ];

    public $limit;
    public $page = 1;
    public $orderBy = null;

    public function mount($limit = 6, $page = 1)
    {
        $this->limit = $limit;
        $this->page = $page;
    }

    public function loadBlocks()
    {
        $apiUrl = $this->getApiUrl();

        $this->response = Http::get($apiUrl);
    }

    private function getQuery()
    {
        return [
            'limit' => $this->limit,
            'page' => $this->page,
            'orderBy' => $this->orderBy,
        ];
    }

    public function orderBy($orderBy)
    {
        if ($this->orderBy === $orderBy . ':asc') {
            $this->orderBy =  $orderBy . ':desc';
        } else if ($this->orderBy === ':desc') {
            $this->orderBy =  null;
        } else {
            $this->orderBy = $orderBy . ':asc';
        }

        $this->loadBlocks();
    }

    public function nextPage()
    {
        $this->page = $this->page + 1;

        $this->loadBlocks();
    }

    public function gotoPage($page)
    {
        $this->page = $page;

        $this->loadBlocks();
    }

    private function getApiUrl()
    {
        $apiUrl = sprintf('%s/blocks', config('services.ark.endpoint'));
        $query = $this->getQuery();

        if (count($query)) {
            return $apiUrl . '?' . http_build_query($query);
        }

        return $apiUrl;
    }

    private function getPagination()
    {
        if (!$this->response) {
            return null;
        }

        return new LengthAwarePaginator(
            $this->response->json('data'),
            $this->response->json('meta.totalCount'),
            $this->response->json('meta.count'),
            $this->page
        );
    }

    public function render()
    {
        return view('livewire.block-table', [
            'pagination' => $this->getPagination()
        ]);
    }
}
