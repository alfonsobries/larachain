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
        $apiUrl = sprintf('%s/transactions', self::getApiUrl());

        if (count($query)) {
            return $apiUrl . '?' . http_build_query($query);
        }

        return $apiUrl;
    }

    public static function getTransactionsSearchEndpoint()
    {
        return sprintf('%s/transactions/search', self::getApiUrl());
    }

    protected static function getApiUrl()
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
    public static function searchTransactions(array $query = [])
    {
        $enpdoint = self::getTransactionsSearchEndpoint();

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
     * @return array
     */
    public static function transactionsBetween(Carbon $from, Carbon $to)
    {
        $query = [
            'timestamp' => [
                'from' => self::getArkEpoch($from),
                'to' => self::getArkEpoch($to),
            ]
        ];

        return self::searchTransactions($query)->json();
    }

    /** 
     * Returns the lat block
     * 
     * @return \Illuminate\Http\Client\Response
     */
    public static function lastBlockEndpoint()
    {
        return sprintf('%s/blocks/last', self::getApiUrl());
        
        return Http::get($enpdoint);
    }

    /** 
     * Returns the lat block
     * 
     * @return \Illuminate\Http\Client\Response
     */
    public static function getLastBlock()
    {
        $enpdoint = self::lastBlockEndpoint();
        
        return Http::get($enpdoint);
    }

    /**
     * Return the date timestamp with the same offset that ark uses
     * @return int
     */
    protected static function getArkEpoch(Carbon $date)
    {
        return $date->timestamp - self::EPOCH_OFFSET;
    }
    

    public static function fake($override = [])
    {
        Http::fake(array_merge([
            self::lastBlockEndpoint() => FakeArkExplorer::getLastBlock(),
            self::getTransactionsSearchEndpoint() => FakeArkExplorer::searchTransactions(),
        ], $override));
    }
}
