@php

@endphp
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: moment.months(),
            datasets: [
                {
                    label: 'Pemasukan',
                    backgroundColor: 'rgb(0, 0, 0, 0)',
                    borderColor: 'rgb(88, 204, 146)',
                    data: [
                        {{ $chart['January']['jual'] ?? 0 }},
                        {{ $chart['February']['jual'] ?? 0 }},
                        {{ $chart['March']['jual'] ?? 0 }},
                        {{ $chart['April']['jual'] ?? 0 }},
                        {{ $chart['May']['jual'] ?? 0 }},
                        {{ $chart['June']['jual'] ?? 0 }},
                        {{ $chart['July']['jual'] ?? 0 }},
                        {{ $chart['August']['jual'] ?? 0 }},
                        {{ $chart['September']['jual'] ?? 0 }},
                        {{ $chart['October']['jual'] ?? 0 }},
                        {{ $chart['November']['jual'] ?? 0 }},
                        {{ $chart['December']['jual'] ?? 0 }}
                    ]
                },
                {
                    label: 'Pengeluaran',
                    backgroundColor: 'rgb(0, 0, 0, 0)',
                    borderColor: 'rgb(235, 64, 52)',
                    data: [
                        {{ ($chart['January']['beli'] ?? 0) + ($chart['January']['tabungan'] ?? 0) + ($chart['January']['retur'] ?? 0) }},
                        {{ ($chart['February']['beli'] ?? 0) + ($chart['February']['tabungan'] ?? 0) + ($chart['February']['retur'] ?? 0) }},
                        {{ ($chart['March']['beli'] ?? 0) + ($chart['March']['tabungan'] ?? 0) + ($chart['March']['retur'] ?? 0) }},
                        {{ ($chart['April']['beli'] ?? 0) + ($chart['April']['tabungan'] ?? 0) + ($chart['April']['retur'] ?? 0) }},
                        {{ ($chart['May']['beli'] ?? 0) + ($chart['May']['tabungan'] ?? 0) + ($chart['May']['retur'] ?? 0) }},
                        {{ ($chart['June']['beli'] ?? 0) + ($chart['June']['tabungan'] ?? 0) + ($chart['June']['retur'] ?? 0) }},
                        {{ ($chart['July']['beli'] ?? 0) + ($chart['July']['tabungan'] ?? 0) + ($chart['July']['retur'] ?? 0) }},
                        {{ ($chart['August']['beli'] ?? 0) + ($chart['August']['tabungan'] ?? 0) + ($chart['August']['retur'] ?? 0) }},
                        {{ ($chart['September']['beli'] ?? 0) + ($chart['September']['tabungan'] ?? 0) + ($chart['September']['retur'] ?? 0) }},
                        {{ ($chart['October']['beli'] ?? 0) + ($chart['October']['tabungan'] ?? 0) + ($chart['October']['retur'] ?? 0) }},
                        {{ ($chart['November']['beli'] ?? 0) + ($chart['November']['tabungan'] ?? 0) + ($chart['November']['retur'] ?? 0) }},
                        {{ ($chart['December']['beli'] ?? 0) + ($chart['December']['tabungan'] ?? 0) + ($chart['December']['retur'] ?? 0) }}
                    ]
                },
            ]
        },

        // Configuration options go here
        options: {
        }
    });
</script>
