@extends('layouts.matrix')

@section('content')

    @include('partials.breadcrumb', ['title' => $title, 'extra' => [
            [
                'url' => route('kategori-sampah.stok'),
                'name' => 'Stok',
            ]
        ]
    ])

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
                        <div class="row">
                            <div class="col-lg-4 mb-4">
                                <a href="{{ route('kategori-sampah.stok') }}" class="btn btn-secondary"><span class="mdi mdi-arrow-left"></span> Kembali</a>
                            </div>
                        </div>
                        <div class="row align-items-center mb-1 mb-lg-4">
                            <div class="col-lg-4 mb-3 mb-lg-0">
                                <div class="row no-gutters">
                                    <label class="control-label col-md-3 col-form-label">Filter Hari&nbsp;&nbsp;</label>
                                    <div class="col-md-9">
                                        <input id="rangeCalendar" value="{{ now()->format('d/m/Y') }}" type="text" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            {{--<div class="col-lg-4 mb-3 mb-lg-0">
                                <div class="row no-gutters">
                                    <label class="control-label col-md-3 col-lg-4 col-form-label">Filter Hari&nbsp;&nbsp;</label>
                                    <div class="col-md-9 col-lg-8">
                                        <input id="harianCalendar" value="{{ now()->format('d/m/Y') }}" type="text" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 mb-3 mb-lg-0">
                                <div class="row no-gutters">
                                    <label class="control-label col-md-3 col-lg-4 col-form-label">Filter Bulan&nbsp;&nbsp;</label>
                                    <div class="col-md-9 col-lg-8">
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
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 mb-3 mb-lg-0">
                                <h5 class="m-0">Filter: {{ $filterText }}</h5>
                                <a href="{{ request()->url() }}">Reset Filter</a>
                            </div>--}}
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Tanggal</th>
                                    <th>Transaksi</th>
                                    <th>Kode</th>
                                    <th>Kondisi</th>
                                    <th>Pertambahan (Kg)</th>
                                    <th>Pengurangan (Kg)</th>
                                    <th class="nowrap">Reject (Kg)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($stoks as $stok)
                                    <tr>
                                        <td></td>
                                        <td>{{ $stok->store_done_pretty ?? $stok->date_done_pretty ?? $stok->date_mutasi_pretty ?? $stok->date_residu_pretty }}</td>
                                        <td>
                                            @if ($stok instanceof \App\Setoran)
                                                Setoran
                                            @elseif ($stok instanceof \App\Sampahkeluar)
                                                Sampah Keluar
                                            @elseif ($stok instanceof \App\Mutasisampah && $stok->kategorisampah_transfer_id === $kategorisampah_id)
                                                Mutasi
                                            @elseif ($stok instanceof \App\Mutasisampah && $stok->kategorisampah_transfer_id !== $kategorisampah_id)
                                                Dimutasi
                                            @elseif ($stok instanceof \App\Residusampah)
                                                Residu
                                            @endif
                                        </td>
                                        <td>{{ $stok->id_pretty ?? $stok->id }}</td>
                                        <td>{{ $stok->type ?? '-' }}</td>
                                        <td class="text-right">
                                            @if ($stok->setoranDetail && (int) $stok->setoranDetail->first()->status_id === config('constants.statuses.SELESAI'))
                                                {{ $stok->setoranDetail->first()->weight ?? '-' }}
                                            @elseif ($stok->kategorisampah_terima_id === $kategorisampah_id)
                                                {{ $stok->weight_pretty }}
                                            @else
                                                {{ '-' }}
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            @if ($stok->sampahkeluarDetail && (int) $stok->sampahkeluarDetail->first()->status_id === config('constants.statuses.SELESAI'))
                                                {{ $stok->sampahkeluarDetail->first()->weight ?? '-' }}
                                            @elseif ($stok->kategorisampah_transfer_id === $kategorisampah_id)
                                                {{ $stok->weight_pretty }}
                                            @elseif ($stok instanceof \App\Residusampah)
                                                {{ $stok->weight_pretty }}
                                            @else
                                                {{ '-' }}
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            @if ($stok->sampahkeluarDetail && (int) $stok->sampahkeluarDetail->first()->status_id === config('constants.statuses.REJECT'))
                                                {{ $stok->sampahkeluarDetail->first()->weight ?? '-' }}
                                            @elseif ($stok->setoranDetail && (int) $stok->setoranDetail->first()->status_id === config('constants.statuses.REJECT'))
                                                {{ $stok->setoranDetail->first()->weight ?? '-' }}
                                            @else
                                                {{ '-' }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Tanggal</th>
                                    <th>Transaksi</th>
                                    <th>Kode</th>
                                    <th>Kondisi</th>
                                    <th>Pertambahan (Kg)</th>
                                    <th>Pengurangan (Kg)</th>
                                    <th class="nowrap">Reject (Kg)</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h2><strong>{{ str_replace('.', ',', $stoks->filter(function ($item) {
                                    if ($item->setoranDetail)
                                        return $item->setoranDetail->first()->status_id == 9;
                                    return false;
                                })->sum(function ($item) {
                                    if ($item->setoranDetail)
                                        return $item->setoranDetail->first()->weight;
                                })) }}</strong></h2>
                                <span>Total Setoran (Kg)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h2><strong>{{ str_replace('.', ',', $stoks->filter(function ($item) {
                                    if ($item->setoranDetail)
                                        return $item->setoranDetail->first()->status_id == 11;
                                    return false;
                                })->sum(function ($item) {
                                    if ($item->setoranDetail)
                                        return $item->setoranDetail->first()->weight;
                                })) }}</strong></h2>
                                <span>Total Setoran Reject (Kg)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h2><strong>{{ str_replace('.', ',', $stoks->filter(function ($item) {
                                    if ($item->sampahkeluarDetail)
                                            return $item->sampahkeluarDetail->first()->status_id == 9;
                                        return false;
                                    })->sum(function ($item) {
                                        if ($item->sampahkeluarDetail)
                                            return $item->sampahkeluarDetail->first()->weight;
                                    })) }}</strong></h2>
                                <span>Total Sampah Keluar (Kg)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h2><strong>{{ str_replace('.', ',', $stoks->filter(function ($item) {
                                    if ($item->sampahkeluarDetail)
                                            return $item->sampahkeluarDetail->first()->status_id == 11;
                                        return false;
                                    })->sum(function ($item) {
                                        if ($item->sampahkeluarDetail)
                                            return $item->sampahkeluarDetail->first()->weight;
                                    })) }}</strong></h2>
                                <span>Total Sampah Keluar Reject (Kg)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h2><strong>{{ str_replace('.', ',', $stoks->sum(function ($item) use ($kategorisampah_id) {
                                        if ($item->kategorisampah_transfer_id === $kategorisampah_id)
                                            return $item->weight;
                                    })) }}</strong></h2>
                                <span>Total Transfer (Kg)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h2><strong>{{ str_replace('.', ',', $stoks->sum(function ($item) use ($kategorisampah_id) {
                                        if ($item->kategorisampah_terima_id === $kategorisampah_id)
                                            return $item->weight;
                                    })) }}</strong></h2>
                                <span>Total Terima (Kg)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h2><strong>{{ str_replace('.', ',', $stoks->sum(function ($item) use ($kategorisampah_id) {
                                        if ($item instanceof \App\Residusampah)
                                            return $item->weight;
                                    })) }}</strong></h2>
                                <span>Total Residu (Kg)</span>
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
    <script>
        $(function() {
            var prevselection = null;
            $('.bulan-select')
                .select2({
                    minimumResultsForSearch: Infinity,
                    /*templateResult: formatState,
                    templateSelection: formatState*/
                })
                .on('select2:opening', function(event){
                    prevselection = $(event.target).find(':selected');
                    $('select').val(null);
                })
                .on('select2:select', function (event) {

                    var _selection = $(event.target).find(':selected');
                    var available = _selection.data('available');

                    if(available === false){
                        alert('ok')
                    }
                }).on('select2:closing', function (event) {

                    if(prevselection != null && $(this).val() == null){
                        $(this).val($(prevselection).val())
                    }
            });
        });
    </script>
@stop
