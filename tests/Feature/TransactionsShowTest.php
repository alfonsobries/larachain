<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Support\Str;
use App\Services\Ark\ArkExplorer;
use Illuminate\Support\Facades\Http;
use App\Http\Livewire\Pages\TransactionsShow;
use App\Services\Ark\Testing\FakeArkExplorer;

class TransactionsShowTest extends TestCase
{
    /** @test */
    public function it_handles_transactions_withouth_username()
    {
        ArkExplorer::fake([
            ArkExplorer::getWalletEndpoint('*') => function () {
                // Create a wallet with no username
                $wallet = FakeArkExplorer::buildWallet();
                unset($wallet['username']);
                
                $body = [
                    'data' => $wallet,
                ];

                return Http::response($body, 200);
            },
        ]);

        try {
            Livewire::test(TransactionsShow::class)->assertSee('Unknown');
        } catch (\Exception $e) {
            $isUndefinedUserError = Str::of($e->getMessage())->contains('Undefined index: username');

            $this->assertFalse($isUndefinedUserError, 'is not handling the lack of username');

            // Still throw a different exception
            if (!$isUndefinedUserError) {
                throw $e;
            }
        }        
    }
}
