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
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a href="{{ route('kategori-sampah.stok.history') }}" class="btn btn-primary ml-auto">Riwayat Stok</a>
                        </div>

                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
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
                                    <th class="all">Tersedia</th>
                                    <th class="no-sort all">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($stoks as $stok)
                                    <tr>
                                        <td></td>
                                        <td>{{ $stok->kategorisampah->first()->code }}</td>
                                        <td class="text-right">{{ $stok->quantity_tabungan }}</td>
                                        <td class="text-right">{{ $stok->quantity_beli }}</td>
                                        <td class="text-right">{{ $stok->quantity_hibah }}</td>
                                        <td class="text-right">{{ $stok->quantity_mutasi_transfer }}</td>
                                        <td class="text-right">{{ $stok->quantity_mutasi_terima }}</td>
                                        <td class="text-right">{{ $stok->quantity_jual }}</td>
                                        <td class="text-right">{{ $stok->quantity_nonjual }}</td>
                                        <td class="text-right">{{ $stok->quantity_reject }}</td>
                                        <td class="text-right">{{ $stok->quantity_jual_reject }}</td>
                                        <td class="text-right">{{ $stok->quantity_residu }}</td>
                                        <td class="text-right">{{ $stok->quantity_retur }}</td>
                                        <td class="text-right">{{ $stok->kategorisampah->first()->total_weight_minus }}</td>
                                        <td>
                                            <a data-toggle="tooltip" data-placement="top" title="Mutasi" href="{{ route('kategori-sampah.mutasi.show', $stok->kategorisampah->first()->id) }}" class="text-light btn btn-sm btn-dark rounded py-0 px-1">
                                                <span class="mdi mdi-swap-horizontal mdi-18px"></span>
                                            </a>
                                            <span data-toggle="modal" data-target="#residuModal" data-action="{{ route('kategori-sampah.residu.store', $stok->kategorisampah->first()->id) }}" data-katid="{{ $stok->kategorisampah->first()->id }}">
                                                <a href="#"  class="text-light btn btn-sm btn-dark rounded py-0 px-1" data-toggle="tooltip" data-placement="top" data-title="Kelola Residu">
                                                    <span class="mdi mdi-cup-water mdi-18px"></span>
                                                </a>
                                            </span>
                                            <a href="{{ route('kategori-sampah.stok.show', $stok->id) }}" class="text-light btn btn-sm btn-dark rounded py-0 px-1" data-toggle="tooltip" data-placement="top" data-title="Detail">
                                                <span class="mdi mdi-information mdi-18px"></span>
                                            </a>
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
