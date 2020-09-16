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
        $arkExplorer = ArkExplorer::fake();

        $response = $arkExplorer->transactions();
        
        $this->assertEquals(200, $response->getStatusCode());
    }    
}
