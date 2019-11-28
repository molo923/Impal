@extends('layouts.admin')

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
                        <div class="table-responsive">
                            @include('partials.table', [
                                'thead' => [
                                    'ID Bank Sampah',
                                    'Nama Bank Sampah',
                                    'Username',
                                    'Email',
                                    'Nomor Telepon',
                                    'Alamat',
                                    'Status',
                                    'Aksi'
                                ],
                                'datas' => $banksampahs->map(function ($item) {
                                    return [
                                        $item->id,
                                        $item->name,
                                        $item->user->username,
                                        $item->user->email,
                                        $item->user->phone_number,
                                        $item->user->alamat->full_address,
                                        '<span class="badge badge-secondary">' . $item->status->name . '</span>',
                                        '
                                        <button data-action="' . route('admin.banksampah-confirm', $item->id) . '" data-toggle="modal" data-target="#banksampahConfirmModal" class="btn btn-primary btn-sm">Konfirmasi Bank Sampah</button>
                                        '
                                    ];
                                }),
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="banksampahConfirmModal" class="modal fade">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Akun Bank Sampah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="banksampahConfirmForm" class="d-none" action="" method="POST">
                            @csrf
                            @method('PUT')
                        </form>
                        Apakah anda yakin ingin mengaktifkan akun bank sampah ini?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Konfirmasi</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop
@section('extra-script')
    <script>
        $(function() {
            var form = $("#banksampahConfirmForm");
            var modal = $("#banksampahConfirmModal");

            modal.on("show.bs.modal", function(e) {
                var btn = $(e.relatedTarget);
                var action = btn.data("action");

                form.attr("action", action);
            });

            modal.find("button.btn.btn-primary").on("click", function() {
                form.submit();
            });
        });
    </script>
@stop
