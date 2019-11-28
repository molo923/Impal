@extends('layouts.matrix')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Selamat datang, {{ auth()->user()->username }}</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dasbor</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- Column -->
            {{--<div class="col-md-6 col-lg-2 col-xlg-3">
                <a href="{{ route('banksampah.nasabah-index') }}" class="card card-hover">
                    <div class="box bg-cyan">
                        <h1 class="font-light text-white">{{ \App\Nasabah::total() }}</h1>
                        <h6 class="text-white m-0">Total Nasabah</h6>
                    </div>
                </a>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <a href="{{ route('banksampah.pegawai-index') }}" class="card card-hover">
                    <div class="box bg-success">
                        <h1 class="font-light text-white">{{ \App\Pegawai::total() }}</h1>
                        <h6 class="text-white m-0">Total Pegawai</h6>
                    </div>
                </a>
            </div> --}}
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <a href="{{ route('kategori-sampah.index') }}" class="card card-hover">
                    <div class="box bg-warning">
                        <h1 class="font-light text-white">{{ \App\Kategorisampah::totalActive() }}</h1>
                        <h6 class="text-white m-0">Total Kategori Sampah</h6>
                    </div>
                </a>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <a href="{{ route('setoran.index') }}" class="card card-hover">
                    <div class="box bg-danger">
                        <h2 class="font-light text-white">{{ \App\Setoran::total() }} Kg</h2>
                        <h6 class="text-white m-0">Total Sampah Masuk</h6>
                    </div>
                </a>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <a href="{{ route('sampah-keluar.index') }}" class="card card-hover">
                    <div class="box bg-info">
                        <h2 class="font-light text-white">{{ \App\Sampahkeluar::total() }} Kg</h2>
                        <h6 class="text-white m-0">Total Sampah Keluar</h6>
                    </div>
                </a>
            </div>
            <!-- Column -->
            <!-- Column -->
            {{--<div class="col-md-6 col-lg-2 col-xlg-3">
                <a href="{{ route('kategori-sampah.stok') }}" class="card card-hover">
                    <div class="box bg-danger">
                        @php
                            $ks = \App\Kategorisampah::whereHas('banksampahKategorisampah', function($query) {
                                $query->where('banksampah_id', banksampah()->id);
                            })->get();
                        @endphp
                        <h2 class="font-light text-white">
                            {{ $ks->sum(function ($item) {
                                return $item->total_weight_minus;
                            }) . " Kg" }}
                        </h2>
                        <h6 class="text-white m-0">Total Stok Tersedia</h6>
                    </div>
                </a>
            </div> --}}
            <!-- Column -->
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Sampah masuk dan keluar</h4>
                        <p class="text-right font-medium">Minggu ini</p>
                        @include('partials.banksampah.setoran-chart', compact('chartberat'))
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Finansial</h4>
                        @include('partials.banksampah.finansial.week-chart', compact('pengeluarans','pemasukans','finansials','chart','bulan','tahun'))
                    </div>
                </div>
                <!-- card -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title m-b-0">Perpindahan nilai sampah</h4>

                        @if ($kategorisampahs->isEmpty())
                            <div class="text-center">
                                <h5 class="font-medium text-secondary my-5">Belum ada perpindahan harga.</h5>
                            </div>
                        @endif
                        <div class="pt-3">
                            @foreach ($kategorisampahs as $kategorisampah)
                                <div class="border-top border-bottom py-2">
                                    <h6 class="p-0 m-0">{{ $kategorisampah->code }} - <span class="font-medium">{{ $kategorisampah->name }}</span></h6>
                                    <p class="font-bold p-0 m-0">@rp($kategorisampah->banksampahKategorisampah->first()->price_rec)</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Permintaan jemput hari ini</h4>

                        @if ($jemputs->isEmpty())
                            <div class="text-center">
                                <h5 class="font-medium text-secondary my-5">Belum ada permintaan penjemputan.</h5>
                            </div>
                        @endif
                        <div class="pt-3">
                            @foreach ($jemputs as $jemput)
                                {{--<div class="border mb-2 p-3 row no-gutters">
                                    <div class="col-3">
                                        <p class="m-0 font-12 text-muted">Nasabah</p>
                                        <p class="font-14 font-medium">{{ $jemput->setoranJemput->setoran->nasabah->name }}</p>
                                        <p class="m-0 font-12 text-muted">No Telp</p>
                                        <p class="font-14 font-medium">{{ $jemput->setoranJemput->setoran->nasabah->user->phone_number }}</p>
                                        <p class="m-0 font-12 text-muted">Alamat</p>
                                        <p class="m-0 font-12 font-medium">{{ $jemput->setoranJemput->setoran->nasabah->user->alamat->full_address }}</p>
                                    </div>
                                    <div class="col-3">
                                        <p class="m-0 font-12 text-muted">Armada</p>
                                        <p class="m-0 font-14 font-medium">{{ $jemput->fleet }}</p>
                                    </div>
                                    <div class="col-3">
                                        <p class="m-0 font-12 text-muted">Driver</p>
                                        <p class="m-0 font-14 font-medium">{{ $jemput->setoranJemput->pegawai->name ?? '-' }}</p>
                                    </div>
                                    <div class="col-3">
                                        <p class="m-0 font-12 text-muted">Status</p>
                                        <p class="m-0 font-medium">{{ $jemput->status->name }}</p>
                                    </div>
                                </div>--}}
                                <div class="border mb-2 p-3 row no-gutters">
                                    <div class="col-6">
                                        <p class="font-14 font-medium"><i class="mdi mdi-account text-muted mr-1"></i> {{ $jemput->setoranJemput->setoran->nasabah->name }}</p>
                                        <p class="font-14 font-medium"><i class="mdi mdi-phone text-muted mr-1"></i> {{ $jemput->setoranJemput->setoran->nasabah->user->phone_number }}</p>
                                        <p class="m-0 font-12 font-medium"><i class="mdi mdi-map-marker text-muted mr-1"></i> {{ $jemput->setoranJemput->setoran->nasabah->user->alamat->full_address }}</p>
                                    </div>
                                    <div class="col-3">
                                        <p class="m-0 font-12 text-muted">Driver</p>
                                        <p class="font-14 font-medium">{{ $jemput->setoranJemput->pegawai->name ?? '-' }}</p>
                                        <p class="m-0 font-12 text-muted">Armada</p>
                                        <p class="m-0 font-14 font-medium">{{ $jemput->fleet }}</p>
                                    </div>
                                    <div class="col-3">
                                        <p class="m-0 font-12 text-muted">Status</p>
                                        <p class="m-0 font-medium">{{ $jemput->status->name }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection
@section('extra-script')
    @include('partials.banksampah.finansial.charts.minggu', compact('chart'))
    <script>
        var ctx2 = document.getElementById('setoranChart').getContext('2d');
        var charte = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: moment.weekdays(true),
                datasets: [
                    {
                        label: 'Sampah Keluar',
                        borderColor: 'rgb(116, 96, 238)',
                        backgroundColor: 'rgb(116, 96, 238)',
                        data: [
                            {{ $chartberat['Monday']['jual'] ?? 0 }},
                            {{ $chartberat['Tuesday']['jual'] ?? 0 }},
                            {{ $chartberat['Wednesday']['jual'] ?? 0 }},
                            {{ $chartberat['Thursday']['jual'] ?? 0 }},
                            {{ $chartberat['Friday']['jual'] ?? 0 }},
                            {{ $chartberat['Saturday']['jual'] ?? 0 }},
                            {{ $chartberat['Sunday']['jual'] ?? 0 }}
                        ],
                        fill: false,
                        pointStyle: 'rectRot',
                    },
                    {
                        label: 'Sampah Masuk',
                        borderColor: 'rgb(34, 85, 164)',
                        backgroundColor: 'rgb(34, 85, 164)',
                        data: [
                            {{ ($chartberat['Monday']['tabungan'] ?? 0) + ($chartberat['Monday']['beli'] ?? 0) + ($chartberat['Monday']['retur'] ?? 0) }},
                            {{ ($chartberat['Tuesday']['tabungan'] ?? 0) + ($chartberat['Tuesday']['beli'] ?? 0) + ($chartberat['Tuesday']['retur'] ?? 0) }},
                            {{ ($chartberat['Wednesday']['tabungan'] ?? 0) + ($chartberat['Wednesday']['beli'] ?? 0) + ($chartberat['Wednesday']['retur'] ?? 0) }},
                            {{ ($chartberat['Thursday']['tabungan'] ?? 0) + ($chartberat['Thursday']['beli'] ?? 0) + ($chartberat['Thursday']['retur'] ?? 0) }},
                            {{ ($chartberat['Friday']['tabungan'] ?? 0) + ($chartberat['Friday']['beli'] ?? 0) + ($chartberat['Friday']['retur'] ?? 0) }},
                            {{ ($chartberat['Saturday']['tabungan'] ?? 0) + ($chartberat['Saturday']['beli'] ?? 0) + ($chartberat['Saturday']['retur'] ?? 0) }},
                            {{ ($chartberat['Sunday']['tabungan'] ?? 0) + ($chartberat['Sunday']['beli'] ?? 0) + ($chartberat['Sunday']['retur'] ?? 0) }}
                        ],
                        fill: false,
                    },
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return data.datasets[tooltipItem.datasetIndex].label + ": " + tooltipItem.yLabel + " Kg"
                        }
                    }
                },
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
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            callback: function(label, index, labels) {
                                return label+' Kg';
                            }
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.2
                    }
                },
            }
        });
    </script>
@endsection
