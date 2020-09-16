<?php

namespace App\Http\Livewire\Charts;

use Carbon\Carbon;
use Livewire\Component;
use App\Services\Ark\ArkExplorer;

class LatestTransactions extends Component
{
    public $view;
    public $height;
    public $labels = [];
    public $data = [];

    public function mount($view = 'day')
    {
        $this->view = $view;
    }

    public function loadData()
    {
        $dates = $this->getDates();
        
        $transactions = $this->getTransactions($dates);

        $this->labels = $this->getLabels($dates);
        
        $this->data = $this->getData($transactions, $dates);

        $lastBlock = $this->getLastBlock()->json('data');

        $this->height = $lastBlock['height'];
    }

    /**
     * Get the dates for the chart
     */
    protected function getDates()
    {
        // @TODO: grab this from the user settings
        // if (auth()->user()) {
        //     $now = now()->setTimezone('America/Mexico_City');
        // } else {
        //     $now = now();
        // }

        // $now = now()->setTimezone('America/Mexico_City');
        $now = now();

        return collect(range(0, 11))->map(function ($index) use ($now) {
            return $now->copy()->startOfHour()->subHour($index * 2);
        });
    }

    /**
     * Get the transactions for the chart
     * 
     * @return \Illuminate\Support\Collection
     */
    protected function getTransactions($dates)
    {
        $from = $dates->last();
        $to = $dates->first();

        return collect(collect((new ArkExplorer)->transactionsBetween($from, $to)->json())->get('data'));
    }

    /**
     * Get the labels for the chart
     * 
     * @return array
     */
    protected function getData($transactions, $dates)
    {
        return $dates->map(function ($date, $index) use ($transactions, $dates) {
            $nextDate = $dates->get($index + 1);

            $datesInRange = $transactions->filter(function ($transaction) use ($date, $nextDate) {
                $transactionDate = Carbon::createFromTimestamp($transaction['timestamp']['unix']);
                if ($nextDate) {
                    return $transactionDate->betweenIncluded($date, $nextDate);
                } else {
                    return $transactionDate->lte($date);
                }
            });

            return $datesInRange->sum('fee') / ArkExplorer::AMOUNT_DECIMALS;
        });
    }
    
    /**
     * Get the last block
     * 
     * @return array
     */
    protected function getLastBlock()
    {
        return (new ArkExplorer)->getLastBlock();
        
    }
    /**
     * Get the labels for the chart
     * 
     * @return array
     */
    protected function getLabels($dates)
    {
        return $dates
            ->map
            ->format('H:i')
            ->reverse()
            ->values()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.charts.latest-transactions');
    }
}
