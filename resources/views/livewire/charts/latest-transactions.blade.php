<div
    class="flex flex-col mb-4 space-y-4"
    wire:init="loadData"
    view="day"
    x-data="(function() {
        const data = {
            labels: {{ json_encode($labels) }},
            data: {{ json_encode($data) }},
            buildChart: () => {
                var ctx = document.getElementById('myChart').getContext('2d');

                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Ѧ',
                            data: data.data,
                            borderColor: '#6b7280',
                            borderWidth: 2
                        }]
                    },
                    
                    options: {
                        legend: {
                            display: false,
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    callback: function(value, index, values) {
                                        return value + 'Ѧ';
                                    },
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });   
            }
        }

        return data
    })()"
    wire:poll.16000ms="loadData"
    x-init="
        $watch('labels', buildChart)
        $watch('data', buildChart)
    "
>
    <div class="flex flex-col justify-between lg:items-center lg:flex-row">
        <x-subtitle>Latest transactions and blocks</x-subtitle>

        <div class="flex flex-wrap space-x-4 text-sm text-gray-500">
            <span>Height: {{ number_format($height) }}</span>
        </div>
    </div>

    <x-card wire:ignore>
        <canvas
            id="myChart"
            width="400"
            height="100"
            role="img"
            aria-label="Latest transactions and blocks chart"
        ></canvas>
    </x-card>

</div>


@once
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
@endpush
@endonce
