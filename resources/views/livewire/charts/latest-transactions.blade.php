<div class="flex flex-col mb-4 space-y-4">
    <div class="flex flex-col justify-between lg:items-center lg:flex-row">
        <x-subtitle>Latest transactions and blocks</x-subtitle>

        <div class="flex flex-wrap space-x-4 text-sm text-gray-500">
            <span>Height: 13,612,723</span>
            <span>Network: Main</span>
            <span>Supply: 152,074,248 Ѧ</span>
            <span>Market Cap: $55,020,462.93</span>
        </div>
    </div>

    <x-card
        x-data="{}"
        x-init="function() {
            var ctx = document.getElementById('myChart').getContext('2d');
            
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {{ json_encode($labels) }},
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
        ">
        <canvas id="myChart" width="400" height="100" role="img"
            aria-label="Latest transactions and blocks chart"></canvas>

    </x-card>
</div>

@once
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
@endpush
@endonce
