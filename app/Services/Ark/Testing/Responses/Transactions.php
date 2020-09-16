<?php

namespace App\Services\Ark\Testing\Responses;

use Illuminate\Http\Client\Response;
use App\Services\Ark\Testing\Responses\ArkResponse;

class Transactions extends Response
{
    /**
     * Create a new response instance.
     *
     * @param  int $StatusCode
     * @return void
     */
    public function __construct($statusCode, $body)
    {
        $response = new ArkResponse($statusCode, ['test' => 'hola']);

        $this->response = $response;
    }
}
