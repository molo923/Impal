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
                @if ($banksampah_kategorisampah)
                    <div class="alert alert-info alert-dismissible">
                        <span class="text-info">Anda belum mengaktifkan kategori sampah, silahkan pilih terlebih dahulu <a href="{{ route('kategori-sampah.index') }}" class="font-weight-bold text-info">disini.</a></span>
                    </div>
                @endif
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a href="{{ route('sampah-keluar.create') }}" class="btn btn-primary ml-auto"><i class="mdi mdi-plus"></i> Tambah</a>
                        </div>

                        <div class="table-responsive">
                            <table class="zero_config table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="all">ID Sampah Keluar</th>
                                    <th>Tujuan</th>
                                    <th>Tgl Keluar</th>
                                    <th>Tipe</th>
                                    <th>Total Berat (Kg)</th>
                                    <th>Total Harga (Rp)</th>
                                    <th>PIC</th>
                                    <th>Status</th>
                                    <th class="no-sort all">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sampahkeluars as $sampahkeluar)
                                    <tr>
                                        <td></td>
                                        <td><a href="{{ route('sampah-keluar.show', encrypt($sampahkeluar->id)) }}">{{ $sampahkeluar->id_pretty }}</a></td>
                                        <td>{{ $sampahkeluar->destination }}</td>
                                        <td>{{ $sampahkeluar->date_in_pretty }}</td>
                                        <td>{{ $sampahkeluar->type }}</td>
                                        <td class="text-right">{{ $sampahkeluar->total_weight }}</td>
                                        <td>@rp($sampahkeluar->price_total_nett)</td>
                                        <td class="font-medium">{{ $sampahkeluar->pegawai ? $sampahkeluar->pegawai->name : 'Bank Sampah' }}</td>
                                        <td><span class="badge badge-{{ $sampahkeluar->status_id == config('constants.statuses.DIPROSES') ? 'secondary' : ($sampahkeluar->status_id == config('constants.statuses.REJECT') ? 'danger' : 'success') }}">{{ $sampahkeluar->status->name }}</span></td>
                                        <td>
                                            <button type="button" data-id="{{ $sampahkeluar->id }}" data-toggle="modal" data-target="#detailSampahkeluarModal" class="btn btn-sm btn-danger">Detail</button>
                                            {{--<a href="{{ route('sampah-keluar.edit', $sampahkeluar->id) }}" class="btn btn-sm btn-info">Kelola</a>--}}
                                            <button class="btn btn-info btn-sm dropdown-toggle" {{ $sampahkeluar->status_id === config('constants.statuses.SELESAI') ? 'disabled' : '' }} type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kelola</button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{ route('sampah-keluar.edit', encrypt($sampahkeluar->id)) }}" class="dropdown-item"><i class="mdi mdi-pencil-box-outline mr-1 mdi-18px"></i> Edit</a>
                                                @if ($sampahkeluar->status_id === config('constants.statuses.DIPROSES'))
                                                    <a href="#" data-action="{{ route('sampah-keluar.done', encrypt($sampahkeluar->id)) }}" class="sampahkeluar-done-btn dropdown-item"><i class="mdi mdi-check-circle-outline text-success mr-1 mdi-18px"></i> Selesai</a>
                                                    <a href="#" data-action="{{ route('sampah-keluar.reject', encrypt($sampahkeluar->id)) }}" class="sampahkeluar-reject-btn dropdown-item"><i class="mdi mdi-thumb-down-outline text-danger mr-1 mdi-18px"></i> Reject</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th>ID Sampah Keluar</th>
                                    <th>Tujuan</th>
                                    <th>Tgl Keluar</th>
                                    <th>Tipe</th>
                                    <th>Total Berat (Kg)</th>
                                    <th>Total Harga (Rp)</th>
                                    <th>PIC</th>
                                    <th>Status</th>
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

        <form id="sampahkeluarDoneRejectForm" action="" class="d-none" method="POST">
            @csrf
            @method('put')
        </form>

        <div id="detailSampahkeluarModal" class="modal fade">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailSampahkeluarTitle">Detail Sampah Keluar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="detailSampahkeluarBody">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered border-left-0 border-right-0">
                                <thead id="detailSampahkeluarTableHead">

                                </thead>
                                <tbody id="detailSampahkeluarTableBody">

                                </tbody>
                            </table>
                        </div>
                        <div class="row no-gutters">
                            <div class="col-lg-5 offset-lg-7 col-12 row">
                                <span class="col-7 font-medium">Biaya Tambahan:</span>
                                <span class="col-5 text-right font-16 font-bold" id="detailSampahkeluarBiaya"></span>
                            </div>
                            <div class="col-lg-5 offset-lg-7 col-12 row">
                                <span class="col-7 font-medium">Total:</span>
                                <span class="col-5 text-right font-16 font-bold" id="detailSampahkeluarTotal"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Container -->
    <!-- ============================================================== -->
@endsection
@section('extra-script')
    <script>
        $(function() {
            var doneBtn = $(".sampahkeluar-done-btn");
            var rejectBtn = $(".sampahkeluar-reject-btn");
            var form = $("#sampahkeluarDoneRejectForm");

            function setAction(event) {
                event.preventDefault();
                event.stopPropagation();
                var action = $(event.target).data('action');
                form.attr("action", action);
                form.submit();
            }

            doneBtn.on("click", function(e) {
                setAction(e);
            });

            rejectBtn.on("click", function(e) {
                setAction(e);
            });
        });
    </script>
@stop
