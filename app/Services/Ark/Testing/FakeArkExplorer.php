<?php

namespace App\Services\Ark\Testing;

use DateTime;
use Faker\Factory;
use App\Services\Ark\ArkExplorer;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use App\Services\Ark\Testing\Responses\LastBlock;
use App\Services\Ark\Testing\Responses\Transactions;

class FakeArkExplorer extends ArkExplorer
{
    public static function searchTransactions(array $query = [])
    {
        return self::transactions($query);
    }

    public static function transactions(array $query = [])
    {
        $data = collect(range(1, 3))->map(function () {
            return self::buildTransaction();
        });

        $body = [
            'meta' => [],
            'data' => $data,
        ];

        return Http::response($body, 200);
    }

    public static function getTransaction($id)
    {
        $transaction = self::buildTransaction();

        $body = [
            'data' => $transaction,
        ];

        return Http::response($body, 200);
    }

    public static function getTransactionTypes()
    {
        $types = [
            1 => [
                "Transfer" => 0,
                "SecondSignature" => 1,
                "DelegateRegistration" => 2,
                "Vote" => 3,
                "MultiSignature" => 4,
                "Ipfs" => 5,
                "MultiPayment" => 6,
                "DelegateResignation" => 7,
                "HtlcLock" => 8,
                "HtlcClaim" => 9,
                "HtlcRefund" => 10,
            ],
            2 => [
                "Entity" => 6
            ]
        ];

        $body = [
            'data' => $types,
        ];

        return Http::response($body, 200);
    }


    /** 
     * Returns the wallets
     * 
     * @return \Illuminate\Http\Client\Response
     */
    public static function getWallets()
    {
        return Http::response([], 200);
    }

    /** 
     * Returns the wallets
     * 
     * @return \Illuminate\Http\Client\Response
     */
    public static function getWallet($id)
    {
        $wallet = self::buildWallet();

        $body = [
            'data' => $wallet,
        ];

        return Http::response($body, 200);
    }

    /** 
     * Build a random wallet
     * 
     * @return \Illuminate\Http\Client\Response
     */
    public static function buildWallet($overrides = [])
    {
        $faker = Factory::create();

        return array_merge([
            "address" => $faker->sha256,
            "publicKey" => $faker->sha256,
            "nonce" => $faker->numberBetween(1, 100),
            "balance" => $faker->numberBetween(0, 200000000),
            "attributes" => [],
            "isDelegate" => $faker->boolean,
            "isResigned" => $faker->boolean,
            "vote" => $faker->sha256,
            "username" => $faker->userName,
        ], $overrides);
    }

    /** 
     * Build a random block
     * 
     * @return \Illuminate\Http\Client\Response
     */
    public static function buildBlock($overrides = [])
    {
        $faker = Factory::create();
        $date = $faker->dateTimeBetween('-1 day');

        return array_merge([
            "id" => $faker->sha256,
            "version" => 0,
            "height" => $faker->numberBetween(1, 6425405),
            "previous" => $faker->sha256,
            "forged" => [
                "reward" => $faker->numberBetween(100000000, 200000000),
                "fee" => $faker->numberBetween(100000000, 200000000),
                "total" => $faker->numberBetween(100000000, 200000000),
                "amount" => $faker->numberBetween(100000000, 200000000),
            ],
            "payload" => [
                "hash" => $faker->sha256,
                "length" => 0,
            ],
            "generator" => [
                "username" => $faker->userName,
                "address" => $faker->sha256,
                "publicKey" => $faker->sha256,
            ],
            "signature" => $faker->sha256,
            "confirmations" => 0,
            "transactions" => 0,
            "timestamp" => [
                "epoch" => $date->getTimestamp() - ArkExplorer::EPOCH_OFFSET,
                "unix" => $date->getTimestamp(),
                "human" => $date->format(DateTime::ISO8601)
            ]
        ], $overrides);
    }

    /** 
     * Build a random transaction
     * 
     * @return \Illuminate\Http\Client\Response
     */
    public static function buildTransaction($overrides = [])
    {
        $faker = Factory::create();
        $date = $faker->dateTimeBetween('-1 day');

        return array_merge([
            "id" => $faker->sha256,
            "blockId" => $faker->sha256,
            "version" => 2,
            "type" => 0,
            "typeGroup" => 1,
            "amount" => $faker->numberBetween(0, 16000000),
            "fee" => $faker->numberBetween(0, 160000),
            "sender" => $faker->sha256,
            "senderPublicKey" => $faker->sha256,
            "recipient" => $faker->sha256,
            "signature" => $faker->sha256,
            "vendorField" => $faker->text,
            "confirmations" => $faker->numberBetween(0, 300),
            "timestamp" => [
                "epoch" => $date->getTimestamp() - ArkExplorer::EPOCH_OFFSET,
                "unix" => $date->getTimestamp(),
                "human" => $date->format(DateTime::ISO8601)
            ],
            "nonce" =>  $faker->numberBetween(1, 10000)
        ], $overrides);
    }

    /** 
     * Returns the lat block
     * 
     * @return \Illuminate\Http\Client\Response
     */
    public static function getLastBlock()
    {
        $body = [
            "data" => self::buildBlock()
        ];

        return Http::response($body, 200);
    }
}
