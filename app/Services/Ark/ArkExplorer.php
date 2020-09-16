<?php

namespace App\Services\Ark;

use Illuminate\Support\Facades\Http;
use App\Services\Ark\Testing\FakeArkExplorer;

class ArkExplorer
{
    protected function getTransactionsEndpoint(array $query = [])
    {
        $apiUrl = sprintf('%s/transactions', $this->getApiUrl());

        if (count($query)) {
            return $apiUrl . '?' . http_build_query($query);
        }

        return $apiUrl;
    }

    protected function getApiUrl()
    {
        return config('services.ark.endpoint');
    }

    /**
     * @param array $query
     *
     * @return \Illuminate\Http\Client\Response`
     */
    protected function fetchTransactions(array $query = [])
    {
        $enpdoint = $this->getTransactionsEndpoint();

        return Http::get($enpdoint);
    }

    public function transactions(array $query = [])
    {
        $response = $this->fetchTransactions();

        return $response;
    }

    public static function fake()
    {
        return new FakeArkExplorer();
    }
}
