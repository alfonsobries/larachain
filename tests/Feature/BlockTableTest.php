<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\BlockTable;

class BlockTableTest extends TestCase
{
    /** @test */
    public function only_render_the_rows_that_are_passed()
    {
        Livewire::test(BlockTable::class, ['rows' => ['timestamp', 'height']])
            ->assertSet('headers', [
                'timestamp' => 'Time',
                'height' => 'Height',
            ]);
    }
}
