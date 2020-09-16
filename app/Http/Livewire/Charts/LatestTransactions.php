<?php

namespace App\Http\Livewire\Charts;

use Livewire\Component;

class LatestTransactions extends Component
{
    public $view;
    
    public $labels;

    public function mount($view)
    {
        $this->view = 'day';
        $this->labels = $this->getLabels();
    }

    /**
     * Get the labels for the chart
     */
    protected function getLabels()
    {
        // @TODO: grab this from the user settings
        // if (auth()->user()) {
        //     $now = now()->setTimezone('America/Mexico_City');
        // } else {
        //     $now = now();
        // }

        $now = now()->setTimezone('America/Mexico_City');

        return collect(range(0, 11))->map(function ($index) use ($now) {
            return $now->copy()->startOfHour()->subHour($index * 2);
        })
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
