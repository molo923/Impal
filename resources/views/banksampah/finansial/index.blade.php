@extends('layouts.matrix')

@section('content')

    @include('partials.breadcrumb', ['title' => $title])

    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-lg-6 mb-4">
                                <div class="row no-gutters">
                                    <div class="col-md-4 mb-2 mb-lg-0">
                                        <div class="border px-4 pt-2">
                                            <h5>Pemasukan</h5>
                                            <h4 class="text-success">@rp($pemasukans->sum('price_total_nett'))</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2 mb-lg-0">
                                        <div class="border px-4 pt-2">
                                            <h5>Pengeluaran</h5>
                                            <h4 class="text-danger">@rp($pengeluarans->sum('price_total_nett'))</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2 mb-lg-0">
                                        <div class="border px-4 pt-2">
                                            <h5>Tersedia</h5>
                                            <h4 class="text-secondary">@rp($pemasukans->sum('price_total_nett') - $pengeluarans->sum('price_total_nett'))</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-{{ request()->has('tab') ? 'none' : 'block' }} col-lg-6 mb-4">
                                <label class="control-label">Pilih Hari</label>
                                <input id="harianCalendar" value="{{ now()->format('d/m/Y') }}" type="text" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group d-{{ request()->query('tab') !== 'minggu' ? 'none' : 'block' }} col-lg-6" id="week-picker-wrapper">
                                <label class="control-label">Pilih Rentang Minggu</label>
                                <div class="input-group">
                                    <input type="text" class="form-control week-picker" placeholder="Select a Week">
                                </div>
                            </div>
                            <div class="d-{{ request()->query('tab') !== 'bulan' ? 'none' : 'block' }} col-lg-6 mb-4">
                                <label class="control-label">Pilih Bulan</label>
                                <div class="row">
                                    <div class="col-md-7 mb-3 mb-lg-0">
                                        <select class="form-control bulan-select">
                                        </select>
                                    </div>
                                    <div class="col-md-5 mb-3 mb-lg-0">
                                        <select class="form-control tahun-bulan-select">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-{{ request()->query('tab') !== 'tahun' ? 'none' : 'block' }} col-lg-6 mb-4">
                                <label class="control-label">Pilih Tahun</label>
                                <select class="form-control tahun-select">
                                </select>
                            </div>
                        </div>
                        <div>
                            <ul class="d-block d-lg-none nav nav-pills finansial mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->query('tab') !== 'bulan' && request()->query('tab') !== 'tahun' && request()->query('tab') !== 'minggu' || !request()->has('tab') ? 'active' : '' }}" href="{{ request()->url() }}" role="tab">
                                        <span class="hidden-sm-up"></span> <span class="hidden-xs-down">Hari</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->query('tab') === 'minggu' ? 'active' : '' }}" href="{{ request()->url() . '?tab=minggu' }}" role="tab">
                                        <span class="hidden-sm-up"></span> <span class="hidden-xs-down">Minggu</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->query('tab') === 'bulan' ? 'active' : '' }}" href="{{ request()->url() . '?tab=bulan' }}" role="tab">
                                        <span class="hidden-sm-up"></span> <span class="hidden-xs-down">Bulan</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->query('tab') === 'tahun' ? 'active' : '' }}" href="{{ request()->url() . '?tab=tahun' }}" role="tab">
                                        <span class="hidden-sm-up"></span> <span class="hidden-xs-down">Tahun</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="d-none d-lg-flex nav nav-tabs mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->query('tab') !== 'bulan' && request()->query('tab') !== 'tahun' && request()->query('tab') !== 'minggu' || !request()->has('tab') ? 'active' : '' }}" href="{{ request()->url() }}" role="tab">
                                        <span class="hidden-sm-up"></span> <span class="hidden-xs-down">Hari</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->query('tab') === 'minggu' ? 'active' : '' }}" href="{{ request()->url() . '?tab=minggu' }}" role="tab">
                                        <span class="hidden-sm-up"></span> <span class="hidden-xs-down">Minggu</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->query('tab') === 'bulan' ? 'active' : '' }}" href="{{ request()->url() . '?tab=bulan' }}" role="tab">
                                        <span class="hidden-sm-up"></span> <span class="hidden-xs-down">Bulan</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->query('tab') === 'tahun' ? 'active' : '' }}" href="{{ request()->url() . '?tab=tahun' }}" role="tab">
                                        <span class="hidden-sm-up"></span> <span class="hidden-xs-down">Tahun</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="d-{{ request()->query('tab') === 'minggu' || request()->query('tab') === 'tahun' ? 'block' : 'none' }}">
                                <div class="card">
                                    <div class="card-body">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane active" id="bulan" role="tabpanel">
                                    <table class="zero_config table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Nomor</th>
                                            <th class="all">Tanggal</th>
                                            <th class="all">Nominal</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($finansials as $finansial)
                                            <tr>
                                                <td></td>
                                                <td>{{ $finansial->id_pretty }}</td>
                                                <td>{{ $finansial->store_in_pretty ?? $finansial->date_in_pretty }}</td>
                                                <td>
                                                    <span class="h5 text-{{ $finansial instanceof \App\Setoran ? 'danger' : 'success' }}">
                                                        {{ $finansial instanceof \App\Setoran ? '-' : '+' }}@rp($finansial->price_total_nett)
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Nomor</th>
                                            <th>Tanggal</th>
                                            <th>Nominal</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

@endsection

@section('extra-script')
    @if (request()->query('tab') === 'minggu')
        @include('partials.banksampah.finansial.charts.minggu', ['chart' => $chart])
    @endif
    @if (request()->query('tab') === 'tahun')
        @include('partials.banksampah.finansial.charts.tahun', ['chart' => $chart])
    @endif
@endsection
