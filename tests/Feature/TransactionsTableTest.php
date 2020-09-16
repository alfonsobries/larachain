<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\TransactionsTable;

class TransactionsTableTest extends TestCase
{
    /** @test */
    public function only_render_the_rows_that_are_passed()
    {
        Livewire::test(TransactionsTable::class, ['rows' => ['id', 'sender']])
            ->assertSet('headers', [
                'id' => 'Id',
                'sender' => 'Sender',
            ]);
    }

     /** @test */
     public function render_all_rows_if_no_rows_passed()
     {
         Livewire::test(TransactionsTable::class)
             ->assertSet('headers', TransactionsTable::HEADERS);
     }
}
