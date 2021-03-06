<?php

namespace Tests\Feature\Charts;

use DateTime;
use Tests\TestCase;
use Livewire\Livewire;
use App\Services\Ark\ArkExplorer;
use Illuminate\Support\Facades\Http;
use App\Services\Ark\Testing\FakeArkExplorer;

class LatestTransactionsTest extends TestCase
{
    /** @test */
    public function it_renders_the_component()
    {
        $this->get(route('welcome'))->assertSeeLivewire('charts.latest-transactions');
    }

    /** @test */
    public function it_calculates_the_labels_for_the_day_view()
    {
        ArkExplorer::fake();

        $now = now()->setTime(10, 30);
        
        $this->travelTo($now);

        $hoursToCheck = collect(range(0, 11))->map(function ($index) use ($now) {
            return $now->copy()->startOfHour()->subHour($index*2);
        })->reverse()->values();

        $exceptectLabels = $hoursToCheck->map(function ($hour) {
            return $hour->format('H:i');
        })->toArray();

        $this->assertEquals('12:00', $exceptectLabels[0]);
        
        $this->assertEquals('10:00', $exceptectLabels[11]);
        
        $this->assertCount(12, $exceptectLabels);

        Livewire::test('charts.latest-transactions', ['view' => 'day'])
            ->call('loadData')
            ->assertSet('view', 'day')
            ->assertSet('labels', $exceptectLabels);
    }

    /** @test */
    public function it_calculate_the_values_for_the_day_view()
    {
        $now = now()->setTime(10, 30);

        $this->travelTo($now);
        
        ArkExplorer::fake([
            ArkExplorer::getTransactionsSearchEndpoint() => function () use ($now) {
                $date = $now->copy()->subHours(6);

                $data[] = FakeArkExplorer::buildTransaction([
                    "amount" => 16000000,
                    "timestamp" => [
                        "epoch" => $date->getTimestamp() - ArkExplorer::EPOCH_OFFSET,
                        "unix" => $date->getTimestamp(),
                        "human" => $date->format(DateTime::ISO8601)
                    ]
                ]);

                $body = [
                    'meta' => [],
                    'data' => $data,
                ];

                return Http::response($body, 200);
            },
        ]);
        
        $dataToCheck = collect(range(0, 11))->map(function ($index) use ($now) {
            return 0;
        })->values()->toArray();

        $dataToCheck[2] = 0.16;
        
        Livewire::test('charts.latest-transactions', ['view' => 'day'])
            ->call('loadData')
            ->assertSet('view', 'day')
            ->assertSet('data', $dataToCheck);
    }
}
