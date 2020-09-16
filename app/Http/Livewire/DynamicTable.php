<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class DynamicTable extends Component
{
    const PAGINATION_PATH = '/';
    protected $response = null;

    public $headers = [];
    public $orderable = [];
    public $limit;
    public $page = 1;
    public $orderBy = null;
    public $hidePagination = false;

    public function mount($limit = 6, $rows = [], $headers = [], $orderable = [], $hidePagination = false)
    {
        $this->limit = $limit;
        
        $this->page = request()->input('page', 1);

        if (count($rows)) {
            $this->headers = array_filter($headers, function ($key) use ($rows) {
                return in_array($key, $rows);
            }, ARRAY_FILTER_USE_KEY);
        } else {
            $this->headers = $headers;
        }
        
        $this->orderable = $orderable;
        $this->hidePagination = $hidePagination;
    }

    public function loadData()
    {
        $this->response = $this->getResponse();
    }

    protected function getQuery()
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

        $this->loadData();
    }

    protected function getPagination()
    {
        if (!$this->response) {
            return null;
        }

        return new LengthAwarePaginator(
            $this->response->json('data'),
            $this->response->json('meta.totalCount'),
            $this->response->json('meta.count'),
            $this->page,
            ['path' => $this->getPaginationRoute()]
        );
    }

    abstract protected function getResponse();

    abstract public function getPaginationRoute();
    
    abstract public function render();
}
