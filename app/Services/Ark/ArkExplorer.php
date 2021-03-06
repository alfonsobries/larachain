<?php

namespace App\Services\Ark;

use App\Services\Ark\Testing\FakeArkExplorer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ArkExplorer
{
    /**
     * For some reason the ark epoch that is the date used to query
     * transactions between dates has a `1490101200` offset
     * issue: https://github.com/ArkEcosystem/deployer/issues/38.
     */
    const EPOCH_OFFSET = 1490101200;
    const AMOUNT_DECIMALS = 100000000;

    public static function getWalletsEndpoint(array $query = [])
    {
        $apiUrl = sprintf('%s/wallets', self::getApiUrl());

        if (count($query)) {
            return $apiUrl.'?'.http_build_query($query);
        }

        return $apiUrl;
    }

    public static function getTransactionsEndpoint(array $query = [])
    {
        $apiUrl = sprintf('%s/transactions', self::getApiUrl());

        if (count($query)) {
            return $apiUrl.'?'.http_build_query($query);
        }

        return $apiUrl;
    }

    public static function getBlocksEndpoint(array $query = [])
    {
        $apiUrl = sprintf('%s/blocks', self::getApiUrl());

        if (count($query)) {
            return $apiUrl.'?'.http_build_query($query);
        }

        return $apiUrl;
    }

    public static function getTransactionsSearchEndpoint()
    {
        return sprintf('%s/transactions/search', self::getApiUrl());
    }

    protected static function getApiUrl()
    {
        $api = get_current_api();

        return config('services.ark.'.$api);
    }

    /**
     * @param array $query
     *
     * @return \Illuminate\Http\Client\Response`
     */
    protected static function fetchTransactions(array $query = [])
    {
        $enpdoint = self::getTransactionsEndpoint($query);

        return Http::get($enpdoint);
    }

    public static function transactions(array $query = [])
    {
        $response = self::fetchTransactions($query);

        return $response;
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

    /**
     * Search transactions between to dates.
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
            ],
        ];

        return self::searchTransactions($query)->json();
    }

    /**
     * Returns the last block endpoint.
     *
     * @return \Illuminate\Http\Client\Response
     */
    public static function lastBlockEndpoint()
    {
        return sprintf('%s/blocks/last', self::getApiUrl());
    }

    /**
     * Returns the last block.
     *
     * @return \Illuminate\Http\Client\Response
     */
    public static function getLastBlock()
    {
        $enpdoint = self::lastBlockEndpoint();

        return Http::get($enpdoint);
    }

    /**
     * Returns the block by id.
     *
     * @return \Illuminate\Http\Client\Response
     */
    public static function getBlock($id)
    {
        $enpdoint = self::getBlockEndpoint($id);

        return Http::get($enpdoint);
    }

    /**
     * Returns the last block endpoint.
     *
     * @return \Illuminate\Http\Client\Response
     */
    public static function getBlockEndpoint($id)
    {
        return sprintf('%s/blocks/%s', self::getApiUrl(), $id);
    }

    /**
     * Returns the single wallet endpoint.
     *
     * @return \Illuminate\Http\Client\Response
     */
    public static function getWalletEndpoint($id)
    {
        return sprintf('%s/wallets/%s', self::getApiUrl(), $id);
    }

    /**
     * Returns the wallet by id.
     *
     * @return \Illuminate\Http\Client\Response
     */
    public static function getWallet($id)
    {
        $enpdoint = self::getWalletEndpoint($id);

        return Http::get($enpdoint);
    }

    /**
     * Returns the single wallet endpoint.
     *
     * @return \Illuminate\Http\Client\Response
     */
    public static function getWalletTransactionsEndpoint($id, array $query = [], $modifier = '')
    {
        $apiUrl = sprintf('%s/wallets/%s/transactions%s', self::getApiUrl(), $id, $modifier);

        if (count($query)) {
            return $apiUrl.'?'.http_build_query($query);
        }

        return $apiUrl;
    }

    /**
     * Returns the wallet by id.
     *
     * @return \Illuminate\Http\Client\Response
     */
    public static function getWalletTransactions($id, array $query = [], $modifier = '')
    {
        $enpdoint = self::getWalletTransactionsEndpoint($id, $query, $modifier);

        return Http::get($enpdoint);
    }

    /**
     * Returns the single wallet endpoint.
     *
     * @return \Illuminate\Http\Client\Response
     */
    public static function getWalletVotesEndpoint($id, array $query = [])
    {
        $apiUrl = sprintf('%s/wallets/%s/votes', self::getApiUrl(), $id);

        if (count($query)) {
            return $apiUrl.'?'.http_build_query($query);
        }

        return $apiUrl;
    }

    /**
     * Returns the wallet by id.
     *
     * @return \Illuminate\Http\Client\Response
     */
    public static function getWalletVotes($id, array $query = [])
    {
        $enpdoint = self::getWalletVotesEndpoint($id, $query);

        return Http::get($enpdoint);
    }

    /**
     * Returns the single transaction endpoint.
     *
     * @return \Illuminate\Http\Client\Response
     */
    public static function getTransactionEndpoint($id)
    {
        return sprintf('%s/transactions/%s', self::getApiUrl(), $id);
    }

    /**
     * @param array $query
     *
     * @return \Illuminate\Http\Client\Response`
     */
    protected static function fetchWallets(array $query = [])
    {
        $enpdoint = self::getWalletsEndpoint($query);

        return Http::get($enpdoint);
    }

    public static function wallets(array $query = [])
    {
        $response = self::fetchWallets($query);

        return $response;
    }

    /**
     * Returns the transaction by id.
     *
     * @return \Illuminate\Http\Client\Response
     */
    public static function getTransaction($id)
    {
        $enpdoint = self::getTransactionEndpoint($id);

        return Http::get($enpdoint);
    }

    /**
     * Returns the single transaction types endpint.
     *
     * @return \Illuminate\Http\Client\Response
     */
    public static function getTransactionTypesEndpoint()
    {
        return sprintf('%s/transactions/types', self::getApiUrl());
    }

    /**
     * Returns the transaction types.
     *
     * @return \Illuminate\Http\Client\Response
     */
    public static function getTransactionTypes()
    {
        $enpdoint = self::getTransactionTypesEndpoint();

        return Http::get($enpdoint);
    }

    /**
     * @param array $query
     *
     * @return \Illuminate\Http\Client\Response`
     */
    protected static function fetchBlocks(array $query = [])
    {
        $enpdoint = self::getBlocksEndpoint($query);

        return Http::get($enpdoint);
    }

    public static function blocks(array $query = [])
    {
        $response = self::fetchBlocks($query);

        return $response;
    }

    /**
     * Return the date timestamp with the same offset that ark uses.
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
            self::getTransactionsEndpoint() => FakeArkExplorer::transactions(),
            self::getTransactionTypesEndpoint() => FakeArkExplorer::getTransactionTypes(),
            self::getWalletsEndpoint() => FakeArkExplorer::getWallets(),
            self::getWalletEndpoint('*') => FakeArkExplorer::getWallet('*'),
            self::getTransactionEndpoint('*') => FakeArkExplorer::getTransaction('*'),
        ], $override));
    }
}
