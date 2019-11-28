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
                            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link font-16 active" id="belumkonfirmasi-tab" data-toggle="tab" href="#belumkonfirmasi" role="tab">Belum Dikonfirmasi @if ($setoran_payments->count() > 0) <span class="no-el badge-notification" data-badge="{{ $setoran_payments->count() }}"></span> @endif</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-16" id="selesai-tab" data-toggle="tab" href="#selesai" role="tab">Selesai</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="belumkonfirmasi" role="tabpanel">
                                    @include('partials.table', [
                                        'thead' => [
                                            'ID Setoran',
                                            'Nama Bank Sampah',
                                            'Nama Nasabah',
                                            'Metode Pembayaran',
                                            'Pembayaran Via',
                                            'Jumlah Bayar',
                                            'Status',
                                            'Aksi'
                                        ],
                                        'datas' => $setoran_payments->map(function ($item) {
                                            return [
                                                $item->setoran->id_pretty,
                                                $item->setoran->banksampah->name,
                                                $item->setoran->nasabah->name,
                                                $item->payment_method,
                                                $item->bankAccount->detail ?? "OVO " . $item->ovo_number,
                                                $item->setoran->price_total_nett_rp,
                                                '<span class="badge badge-secondary">' . $item->status->name . '</span>',
                                                '
                                                <button data-toggle="modal" data-action="' . route('admin.payment-received', $item->id) . '" data-target="#paymentReceivedModal" class="btn btn-primary btn-sm">Pembayaran Diterima</button>
                                                '
                                            ];
                                        }),
                                    ])
                                </div>
                                <div class="tab-pane fade" id="selesai" role="tabpanel">
                                    @include('partials.table', [
                                        'thead' => [
                                            'ID Setoran',
                                            'Nama Bank Sampah',
                                            'Nama Nasabah',
                                            'Metode Pembayaran',
                                            'Pembayaran Via',
                                            'Jumlah Bayar',
                                            'Status',
                                        ],
                                        'datas' => $setoran_payments_done->map(function ($item) {
                                            return [
                                                $item->setoran->id_pretty,
                                                $item->setoran->banksampah->name,
                                                $item->setoran->nasabah->name,
                                                $item->payment_method,
                                                $item->bankAccount->detail ?? "OVO " . $item->ovo_number,
                                                $item->setoran->price_total_nett_rp,
                                                '<span class="badge badge-success">' . $item->status->name . '</span>',
                                            ];
                                        }),
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="paymentReceivedModal" class="modal fade">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terima Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" class="d-none">
                        @csrf
                        @method('PUT')
                    </form>
                    Apakah anda yakin ingin menerima pembayaran ini?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Terima Pembayaran</button>
                </div>
            </div>
        </div>
    </div>

@stop
@section('extra-script')
    <script>
        $(function() {
            var modal = $("#paymentReceivedModal");
            var form = modal.find("form");

            modal.on("show.bs.modal", function(e) {
                var btn = $(e.relatedTarget);
                var action = btn.data("action");

                form.attr("action", action);
            });

            modal.find(".btn-primary").on("click", function(e) {
                form.submit();
            });
        });
    </script>
@stop
