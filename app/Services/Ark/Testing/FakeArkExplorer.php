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
    // public function __contruct($data = [])
    // {
    //     # code...
    // }

    /**
     * @param array $query
     *
     * @return \App\Services\Ark\Testing\Responses\Transactions`
     */
    protected function fetchTransactions(array $query = [])
    {
        return new Transactions(200, [
        ]);
    }

    public static function searchTransactions(array $query = [])
    {
        $body = collect(range(1, 6))->map(function () {
            return self::buildBlock();
        });

        return Http::response($body, 200);
    }

    /** 
     * Returns the lat block
     * 
     * @return \Illuminate\Http\Client\Response
     */
    public static function buildBlock()
    {
        $faker = Factory::create();
        $date = $faker->dateTimeBetween('-1 day');

        return [
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
        ];
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
