    <div class="fw-lighter mb-3">
        Transactions <a href="{{ route('dashboard.transactions', ['note' => $miner['note']]) }}">View All</a>
    </div>
<div>
    <div style="position: relative; height:150px; width:100vh">
        <canvas class="chart_container" id="chart_container_{{$miner['on_boarding']}}"></canvas>
        @php
            $transactionDatesForMiner = $miner['transactions']->groupBy(function ($transaction) {
                return \Carbon\Carbon::createFromTimestamp($transaction->round_time)->format('Y-m-d');
            })->keys();

            $transactionValuesForMiner = $miner['transactions']->groupBy(function ($transaction) {
                return \Carbon\Carbon::createFromTimestamp($transaction->round_time)->format('Y-m-d');
            })->map->count();
        @endphp
    </div>
    <script>

        const ctx1_{{$miner['on_boarding']}} = document.getElementById("chart_container_{{$miner['on_boarding']}}").getContext('2d');

        let gradientFill_{{$miner['on_boarding']}} = ctx1_{{$miner['on_boarding']}}.createLinearGradient(0, 0, 0, ctx1_{{$miner['on_boarding']}}.canvas.clientHeight);
        gradientFill_{{$miner['on_boarding']}}.addColorStop(0, 'rgba(0, 123, 255, 0.3)');
        gradientFill_{{$miner['on_boarding']}}.addColorStop(1, 'rgba(255, 255, 255, 0)');

        const labels_{{$miner['on_boarding']}} = @json($transactionDatesForMiner);
        const dataValues_{{$miner['on_boarding']}} = @json($transactionValuesForMiner);

        const data_{{$miner['on_boarding']}} = {
            labels: labels_{{$miner['on_boarding']}},
            datasets: [{
                label: 'Transactions',
                data: dataValues_{{$miner['on_boarding']}},
                fill: true,
                backgroundColor: gradientFill_{{$miner['on_boarding']}},
                borderColor: 'rgb(0, 123, 255)',
                pointRadius: 0, // Hides the data points
                lineTension: 0.3, // Smoothes the line
            }]
        };

        const options_{{$miner['on_boarding']}} = {
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: false
                }
            },
            scales: {
                x: {
                    display: false
                },
                y: {
                    display: false
                }
            },
            elements: {
                line: {
                    tension: 0.1
                }
            },
            maintainAspectRatio: true,
            responsive: true
        };
        // Initialize the first chart
        const chart_id_{{$miner['on_boarding']}} = new Chart(ctx1_{{$miner['on_boarding']}}, {
            type: 'line',
            data: data_{{$miner['on_boarding']}},
            options: options_{{$miner['on_boarding']}}
        });
    </script>
</div>
