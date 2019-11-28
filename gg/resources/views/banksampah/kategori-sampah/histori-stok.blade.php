@extends('layouts.matrix')

@section('content')

    @include('partials.breadcrumb', ['title' => $title, 'extra' => [
            [
                'url' => route('kategori-sampah.stok'),
                'name' => 'Stok Sampah',
            ],
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
                        <div class="row mb-4">
                            <div class="col-12 col-lg-6 offset-lg-2 text-right order-lg-2">
                                {{--<a href="{{ route('kategori-sampah.stok') }}" class="btn btn-primary">Stok saat ini</a>--}}
                            </div>
                            <div class="col-12 col-lg-4 order-lg-1">
                                <label class="control-label">Pilih Bulan</label>
                                <div class="row">
                                    <div class="col-6">
                                        <select class="form-control bulan-select" style="width: 100%">
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <select class="form-control tahun-bulan-select" style="width: 100%">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="all">Kode</th>
                                    <th>Tabungan</th>
                                    <th>Beli</th>
                                    <th>Hibah</th>
                                    <th>Transfer</th>
                                    <th>Terima</th>
                                    <th>Jual</th>
                                    <th>Non jual</th>
                                    <th>Reject</th>
                                    <th>Jual Reject</th>
                                    <th>Residu</th>
                                    <th>Retur</th>
                                    <th>Tersedia</th>
                                    <th class="no-sort all">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($stoks as $stok)
                                    <tr>
                                        <td></td>
                                        <td>{{ $stok->code }}</td>
                                        <td class="text-right">{{ $qt = $stok->setorans
                                            ->where('type', 'tabungan')
                                            ->where('status_id', '9')
                                            ->sum(function ($item) use ($stok) {
                                                return $item->setoranDetail->where('kategorisampah_id', $stok->id)->sum('weight');
                                            }) ?? 0 }}</td>
                                        <td class="text-right">{{ $qb = $stok->setorans
                                            ->where('type', 'beli')
                                            ->where('status_id', '9')
                                            ->sum(function ($item) use ($stok) {
                                                return $item->setoranDetail->where('kategorisampah_id', $stok->id)->sum('weight');
                                            }) ?? 0 }}</td>
                                        <td class="text-right">{{ $qh = $stok->setorans
                                            ->where('type', 'hibah')
                                            ->where('status_id', '9')
                                            ->sum(function ($item) use ($stok) {
                                                return $item->setoranDetail->where('kategorisampah_id', $stok->id)->sum('weight');
                                            }) ?? 0 }}</td>
                                        <td class="text-right">{{ $qtr = $stok->transfer
                                            ->sum('weight') ?? 0 }}</td>
                                        <td class="text-right">{{ $qte = $stok->terima
                                            ->sum('weight') ?? 0 }}</td>
                                        <td class="text-right">{{ $qj = $stok->sampahkeluars
                                            ->where('type', 'jual')
                                            ->where('status_id', '9')
                                            ->sum(function ($item) use ($stok) {
                                                return $item->sampahkeluarDetail->where('kategorisampah_id', $stok->id)->sum('weight');
                                            }) ?? 0 }}</td>
                                        <td class="text-right">{{ $qnj = $stok->sampahkeluars
                                            ->where('type', 'nonjual')
                                            ->where('status_id', '9')
                                            ->sum(function ($item) use ($stok) {
                                                return $item->sampahkeluarDetail->where('kategorisampah_id', $stok->id)->sum('weight');
                                            }) ?? 0 }}</td>
                                        <td class="text-right">{{ $qr = $stok->setorans
                                            ->where('status_id', '11')
                                            ->sum(function ($item) use ($stok) {
                                                return $item->setoranDetail->where('kategorisampah_id', $stok->id)->sum('weight');
                                            }) ?? 0 }}</td>
                                        <td class="text-right">{{ $qjr = $stok->sampahkeluars
                                            ->where('status_id', '11')
                                            ->sum(function ($item) use ($stok) {
                                                return $item->sampahkeluarDetail->where('kategorisampah_id', $stok->id)->sum('weight');
                                            }) ?? 0 }}</td>
                                        <td class="text-right">{{ $qre = $stok->residu
                                            ->sum('weight') ?? 0 }}</td>
                                        <td class="text-right">{{ $qrt = $stok->setorans
                                            ->where('type', 'retur')
                                            ->where('status_id', '9')
                                            ->sum(function ($item) use ($stok) {
                                                return $item->setoranDetail->where('kategorisampah_id', $stok->id)->sum('weight');
                                            }) ?? 0 }}</td>
                                        <td class="text-right">{{ $qt+$qb+$qh-$qtr+$qte-$qj-$qr-$qnj-$qjr-$qre+$qrt }}</td>
                                        <td>
                                            <a data-toggle="tooltip" data-placement="top" title="Mutasi" href="{{ route('kategori-sampah.mutasi.show', $stok->id) }}" class="text-light btn btn-sm btn-dark rounded {{ !$now ? 'disabled' : '' }} py-0 px-1">
                                                <span class="mdi mdi-swap-horizontal mdi-18px"></span>
                                            </a>
                                            <span data-toggle="modal" data-target="#residuModal" data-action="{{ route('kategori-sampah.residu.store', $stok->id) }}" data-katid="{{ $stok->id }}">
                                                <a href="#" class="text-light btn btn-sm btn-dark {{ !$now ? 'disabled' : '' }} rounded py-0 px-1" data-toggle="tooltip" data-placement="top" data-title="Kelola Residu">
                                                    <span class="mdi mdi-cup-water mdi-18px"></span>
                                                </a>
                                            </span>
                                            <a href="{{ route('kategori-sampah.stok.show', $stok->stok->first()->id) }}{{ !$now ? '?start=' . request()->query('start') . '&end=' . request()->query('end') : '' }}" class="text-light btn btn-sm btn-dark rounded py-0 px-1" data-toggle="tooltip" data-placement="top" data-title="Detail"><span class="mdi mdi-information mdi-18px"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Kode</th>
                                    <th>Tabungan</th>
                                    <th>Beli</th>
                                    <th>Hibah</th>
                                    <th>Transfer</th>
                                    <th>Terima</th>
                                    <th>Jual</th>
                                    <th>Non jual</th>
                                    <th>Reject</th>
                                    <th>Jual Reject</th>
                                    <th>Residu</th>
                                    <th>Retur</th>
                                    <th>Tersedia</th>
                                    <th>Aksi</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
        <div id="residuModal" class="modal fade">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Residu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="residuSampahForm" action="" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="weight">Berat Sampah</label>
                                        <div class="input-group">
                                            <input type="text" name="weight" placeholder="0.0" class="form-control @error('weight') is-invalid @enderror">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Kg</span>
                                            </div>
                                        </div>

                                        @error('weight')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" disabled class="btn btn-primary" onclick="event.preventDefault();
                                                                               document.getElementById('residuSampahForm').submit()">Kelola</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection
