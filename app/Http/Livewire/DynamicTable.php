<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class DynamicTable extends Component
{
    protected $response = null;

    public $headers = [];
    public $orderable = [];
    public $limit;
    public $page = 1;
    public $orderBy = null;

    public function mount($limit = 6, $page = 1)
    {
        $this->limit = $limit;
        $this->page = $page;
    }

    public function loadData()
    {
        $apiUrl = $this->getApiUrl();

        $this->response = Http::get($apiUrl);
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

    public function nextPage()
    {
        $this->page = $this->page + 1;

        $this->loadData();
    }

    public function gotoPage($page)
    {
        $this->page = $page;

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
            $this->page
        );
    }

    abstract protected function getApiUrl();
    
    abstract public function render();
}
