<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\Ark\ArkExplorer;

class ArkExplorerTest extends TestCase
{
    /** @test */
    public function can_create_an_instance_of_the_ark_explorer()
    {
        $arkExplorer = new ArkExplorer();

        $this->assertInstanceOf(ArkExplorer::class, $arkExplorer);
    }

    /** @test */
    public function can_get_transactions()
    {
        ArkExplorer::fake();

        $response = ArkExplorer::transactions();
        
        $this->assertEquals(200, $response->getStatusCode());
    }    

    /** @test */
    public function can_get_last_block()
    {
        ArkExplorer::fake();

        $response = ArkExplorer::getLastBlock();
        
        $this->assertEquals(200, $response->getStatusCode());
    }    

    /** @test */
    public function can_search_for_transactions()
    {
        ArkExplorer::fake();

        $response = ArkExplorer::searchTransactions();
        
        $this->assertEquals(200, $response->getStatusCode());
    
    
    }    
    /** @test */
    public function can_get_wallet_transactions()
    {
        ArkExplorer::fake();

        $response = ArkExplorer::getWalletTransactions(1);
        
        $this->assertEquals(200, $response->getStatusCode());
    }    
}
