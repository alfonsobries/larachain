<?php

namespace App\Services\Ark\Testing;

use App\Services\Ark\ArkExplorer;
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
}
