<?php

namespace App\Services\Ark;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Services\Ark\Testing\FakeArkExplorer;

class ArkExplorer
{
    /**
     * For some reason the ark epoch that is the date used to query 
     * transactions between dates has a `1490101200` offset
     * issue: https://github.com/ArkEcosystem/deployer/issues/38
     */
    const EPOCH_OFFSET = 1490101200;
    const AMOUNT_DECIMALS = 100000000;

    protected function getTransactionsEndpoint(array $query = [])
    {
        $apiUrl = sprintf('%s/transactions', $this->getApiUrl());

        if (count($query)) {
            return $apiUrl . '?' . http_build_query($query);
        }

        return $apiUrl;
    }

    protected function getTransactionsSearchEndpoint()
    {
        return sprintf('%s/transactions/search', $this->getApiUrl());
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

    /**
     * @param array $query
     *
     * @return \Illuminate\Http\Client\Response`
     */
    public function searchTransactions(array $query = [])
    {
        $enpdoint = $this->getTransactionsSearchEndpoint();

        return Http::post($enpdoint, $query);
    }

    public function transactions(array $query = [])
    {
        $response = $this->fetchTransactions();

        return $response;
    }

    /** 
     * Search transactions between to dates
     * @param \Carbon\Carbon $from
     * @param \Carbon\Carbon $to
     * 
     * @return \Illuminate\Http\Client\Response
     */
    public function transactionsBetween(Carbon $from, Carbon $to)
    {
        $query = [
            'timestamp' => [
                'from' => $this->getArkEpoch($from),
                'to' => $this->getArkEpoch($to),
            ]
        ];

        return $this->searchTransactions($query);
    }

    /** 
     * Returns the lat block
     * 
     * @return \Illuminate\Http\Client\Response
     */
    public function getLastBlock()
    {
        $enpdoint = sprintf('%s/blocks/last', $this->getApiUrl());
        return Http::get($enpdoint);
    }

    /**
     * Return the date timestamp with the same offset that ark uses
     * @return int
     */
    protected function getArkEpoch(Carbon $date)
    {
        return $date->timestamp - self::EPOCH_OFFSET;
    }
    

    public static function fake()
    {
        return new FakeArkExplorer();
    }
}
