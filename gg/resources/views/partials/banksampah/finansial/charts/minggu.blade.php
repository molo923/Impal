<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: moment.weekdays(true),
            datasets: [
                {
                    label: 'Pemasukan',
                    borderColor: 'rgb(88, 204, 146)',
                    backgroundColor: 'rgb(88, 204, 146)',
                    data: [
                        {{ $chart['Monday']['jual'] ?? 0 }},
                        {{ $chart['Tuesday']['jual'] ?? 0 }},
                        {{ $chart['Wednesday']['jual'] ?? 0 }},
                        {{ $chart['Thursday']['jual'] ?? 0 }},
                        {{ $chart['Friday']['jual'] ?? 0 }},
                        {{ $chart['Saturday']['jual'] ?? 0 }},
                        {{ $chart['Sunday']['jual'] ?? 0 }}
                    ],
                    fill: false,
                    pointStyle: 'rectRot',
                },
                {
                    label: 'Pengeluaran',
                    borderColor: 'rgb(235, 64, 52)',
                    backgroundColor: 'rgb(235, 64, 52)',
                    data: [
                        {{ ($chart['Monday']['tabungan'] ?? 0) + ($chart['Monday']['beli'] ?? 0) + ($chart['Monday']['retur'] ?? 0) }},
                        {{ ($chart['Tuesday']['tabungan'] ?? 0) + ($chart['Tuesday']['beli'] ?? 0) + ($chart['Tuesday']['retur'] ?? 0) }},
                        {{ ($chart['Wednesday']['tabungan'] ?? 0) + ($chart['Wednesday']['beli'] ?? 0) + ($chart['Wednesday']['retur'] ?? 0) }},
                        {{ ($chart['Thursday']['tabungan'] ?? 0) + ($chart['Thursday']['beli'] ?? 0) + ($chart['Thursday']['retur'] ?? 0) }},
                        {{ ($chart['Friday']['tabungan'] ?? 0) + ($chart['Friday']['beli'] ?? 0) + ($chart['Friday']['retur'] ?? 0) }},
                        {{ ($chart['Saturday']['tabungan'] ?? 0) + ($chart['Saturday']['beli'] ?? 0) + ($chart['Saturday']['retur'] ?? 0) }},
                        {{ ($chart['Sunday']['tabungan'] ?? 0) + ($chart['Sunday']['beli'] ?? 0) + ($chart['Sunday']['retur'] ?? 0) }}
                    ],
                    fill: false,
                },
            ]
        },

        // Configuration options go here
        options: {
            responsive: true,
            legend: {
                labels: {
                    usePointStyle: true
                }
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                }],
                yAxes: [{
                    gridLines: {
                        display: true,
                        drawBorder: false
                    },
                    ticks: {
                        callback: function(label, index, labels) {
                            return label/1000+'K';
                        }
                    }
                }]
            },
            elements: {
                line: {
                    tension: 0.2
                }
            }
        }
    });
</script>
