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
                        <div class="d-flex justify-content-end mb-4">
                            {{--<a href="{{ route('dompet.payment-list') }}" {{ \App\SetoranPayment::totalWaiting() > 0 ? 'data-badge='. \App\SetoranPayment::totalWaiting() : '' }} class="btn btn-primary badge-notification">Menunggu Pembayaran</a>--}}
                            <button data-toggle="modal" data-target="#nomorRekeningGG" class="btn btn-primary">Nomor Rekening Gonigoni</button>
                        </div>
                        <div class="" style="width: 100%">
                            <ul class="d-block d-lg-none nav nav-pills dompet my-4" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link font-16 active" id="pembayarannasabah-tab" data-toggle="tab" href="#pembayarannasabah" role="tab">Nasabah Belum Dibayar @if ($setorans->count() > 0) <span class="no-el badge-notification" data-badge="{{ $setorans->count() }}"></span> @endif</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-16" id="menunggupembayaran-tab" data-toggle="tab" href="#menunggupembayaran" role="tab">Menunggu Pembayaran @if ($setoran_payments->count() > 0) <span class="no-el badge-notification" data-badge="{{ $setoran_payments->count() }}"></span> @endif </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-16" id="menunggukonfirmasi-tab" data-toggle="tab" href="#menunggukonfirmasi" role="tab">Menunggu Konfirmasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-16" id="selesai-tab" data-toggle="tab" href="#selesai" role="tab">Selesai @if ($done_notif->count() > 0) <span class="no-el badge-notification" data-badge="{{ $done_notif->count() }}"></span> @endif</a>
                                </li>
                            </ul>
                            <ul class="d-none d-lg-flex nav nav-tabs my-4" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link font-16 active" id="pembayarannasabah-tab" data-toggle="tab" href="#pembayarannasabah" role="tab">Nasabah Belum Dibayar @if ($setorans->count() > 0) <span class="no-el badge-notification" data-badge="{{ $setorans->count() }}"></span> @endif</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-16" id="menunggupembayaran-tab" data-toggle="tab" href="#menunggupembayaran" role="tab">Menunggu Pembayaran @if ($setoran_payments->count() > 0) <span class="no-el badge-notification" data-badge="{{ $setoran_payments->count() }}"></span> @endif </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-16" id="menunggukonfirmasi-tab" data-toggle="tab" href="#menunggukonfirmasi" role="tab">Menunggu Konfirmasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-16" id="selesai-tab" data-toggle="tab" href="#selesai" role="tab">Selesai @if ($done_notif->count() > 0) <span class="no-el badge-notification" data-badge="{{ $done_notif->count() }}"></span> @endif</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="pembayarannasabah" role="tabpanel">
                                    @include('partials.table', [
                                        'thead' => [
                                            'ID Setoran',
                                            'Nama Nasabah',
                                            'Jumlah Bayar',
                                            'Aksi',
                                        ],
                                        'datas' => $setorans->map(function ($item) {
                                            return [
                                                $item->id_pretty,
                                                $item->nasabah->name,
                                                $item->price_total_nett_rp,
                                                '
                                                <button data-toggle="modal" data-target="#bayarModal" data-amount-pretty="'. $item->price_total_nett_rp .'" data-amount="'. $item->price_total .'" data-id="'. $item->id .'" class="btn btn-primary btn-sm">Bayar</button>
                                                '
                                            ];
                                        }),
                                    ])
                                </div>
                                <div class="tab-pane fade" id="menunggupembayaran" role="tabpanel">
                                    @include('partials.table', [
                                        'thead' => [
                                            'ID Setoran',
                                            'Nama Nasabah',
                                            'Metode Pembayaran',
                                            'Pembayaran Via',
                                            'Jumlah Bayar',
                                            'Status',
                                            'Aksi',
                                        ],
                                        'datas' => $setoran_payments->map(function ($item) {
                                            return [
                                                $item->id_pretty,
                                                $item->nasabah->name,
                                                $item->setoranPayment->payment_method,
                                                $item->setoranPayment->bankAccount->detail ?? "OVO " . $item->setoranPayment->ovo_number,
                                                $item->price_total_nett_rp,
                                                '<span class="badge badge-secondary">' . $item->setoranPayment->status->name . '</span>',
                                                '<button class="btn btn-sm btn-primary"
                                                    data-method="' . $item->setoranPayment->payment_method . '"
                                                    data-via="' . ($item->setoranPayment->bankAccount->detail ?? "OVO " . $item->setoranPayment->ovo_number) . '"
                                                    data-total="' . $item->price_total_nett_rp . '"
                                                    data-action="' . route('dompet.pay-confirm', $item->setoranPayment->id) . '"
                                                    data-toggle="modal"
                                                    data-target="#paymentConfirmModal">Konfirmasi Pembayaran</button>',
                                            ];
                                        }),
                                    ])
                                </div>
                                <div class="tab-pane fade" id="menunggukonfirmasi" role="tabpanel">
                                    @include('partials.table', [
                                        'thead' => [
                                            'ID Setoran',
                                            'Nama Nasabah',
                                            'Metode Pembayaran',
                                            'Pembayaran Via',
                                            'Jumlah Bayar',
                                            'Status',
                                        ],
                                        'datas' => $setoran_payments_confirmed->map(function ($item) {
                                            return [
                                                $item->id_pretty,
                                                $item->nasabah->name,
                                                $item->setoranPayment->payment_method,
                                                $item->setoranPayment->bankAccount->detail ?? "OVO " . $item->setoranPayment->ovo_number,
                                                $item->price_total_nett_rp,
                                                '<span class="badge badge-secondary">' . $item->setoranPayment->status->name . '</span>',
                                            ];
                                        }),
                                    ])
                                </div>
                                <div class="tab-pane fade" id="selesai" role="tabpanel">
                                    @include('partials.table', [
                                        'thead' => [
                                            'ID Setoran',
                                            'Nama Nasabah',
                                            'Metode Pembayaran',
                                            'Pembayaran Via',
                                            'Jumlah Bayar',
                                            'Status',
                                        ],
                                        'datas' => $setoran_payments_done->map(function ($item) {
                                            return [
                                                $item->id_pretty,
                                                $item->nasabah->name,
                                                $item->setoranPayment->payment_method,
                                                $item->setoranPayment->bankAccount->detail ?? "OVO " . $item->setoranPayment->ovo_number,
                                                $item->price_total_nett_rp,
                                                '<span class="badge badge-secondary">' . $item->setoranPayment->status->name . '</span>',
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

    <div id="nomorRekeningGG" class="modal fade">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nomor Rekening Gonigoni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="m-bri mb-4 d-flex align-items-center">
                        <div class="flex-shrink-1 border p-2">
                            <img src="http://gonigoni.id/assets/img/bri-logo.png" style="max-height: 30px;" alt="Bank BRI">
                        </div>
                        <div class="pl-3">
                            <p class="m-0 font-16 font-bold body">0633 01 023097 50 2</p>
                            <p class="m-0 font-16 font-bold body">a.n. Firza Maulana Nasution</p>
                        </div>
                    </div>
                    <div class="m-bca mb-4 d-flex align-items-center">
                        <div class="flex-shrink-1 border p-2">
                            <img src="http://gonigoni.id/assets/img/bca-logo.png" style="max-height: 30px;" alt="Bank BCA">
                        </div>
                        <div class="pl-3">
                            <p class="m-0 font-16 font-bold body">8000762190</p>
                            <p class="m-0 font-16 font-bold body">a.n. Firza Maulana Nasution</p>
                        </div>
                    </div>
                    <div class="m-ovo d-flex align-items-center">
                        <div class="flex-shrink-1 border p-2">
                            <img src="http://gonigoni.id/assets/img/ovo-logo.png" style="max-height: 30px;" alt="OVO">
                        </div>
                        <div class="pl-3">
                            <p class="m-0 font-16 font-bold body">+62 822 73696930</p>
                            <p class="m-0 font-16 font-bold body">a.n. Firza Maulana Nasution</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div id="paymentConfirmModal" class="modal fade">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="method">Metode Pembayaran</label>
                                    <p class="m-0 font-medium"></p>
                                </div>
                                <div class="form-group">
                                    <label for="via">Pembayaran Via</label>
                                    <p class="m-0 font-medium"></p>
                                </div>
                                <div class="form-group">
                                    <label for="total">Jumlah yang harus dibayar</label>
                                    <p class="m-0 font-bold"></p>
                                </div>
                                <div class="form-group">
                                    <label for="description">Keterangan <small>(Opsional)</small></label>
                                    <textarea name="description" rows="2" class="form-control" style="resize: none"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <p class="font-medium">Nomor Rekening Gonigoni</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Konfirmasi Pembayaran</button>
                </div>
            </div>
        </div>
    </div>

    <div id="bayarModal" class="modal fade">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bayar setoran nasabah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="bayarForm" action="{{ route('dompet.pay-nasabah') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Jumlah Bayar</label>
                            <p class="m-0 font-bold amount"></p>
                            <input type="hidden" name="amount">
                            <input type="hidden" name="setoran_id">
                        </div>

                        <div class="form-group mb-4">
                            <label for="payment_method">Metode Pembayaran</label>
                            <select name="payment_method" placeholder="Pilih metode pembayaran..." class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                <option value=""></option>
                                <option value="BCA">BCA</option>
                                <option value="BRI">BRI</option>
                                <option value="OVO">OVO</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="transfer_number">Akun Bank</label>
                            @if ($bankaccounts->isEmpty())
                                <h5 class="font-bold text-muted text-center my-5">Anda belum memiliki Akun Bank. <a href="{{ route('banksampah.bank-account') }}">Tambah terlebih dahulu disini.</a></h5>
                            @else
                            <select name="bank_account" class="select2 form-control" placeholder="Pilih akun bank...">
                                <option value=""></option>
                                @foreach ($bankaccounts as $bankaccount)
                                    <option value="{{ $bankaccount->id }}">{{ $bankaccount->bank->name . " " . $bankaccount->number . " a/n " . $bankaccount->name }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                        <div class="ovo_number form-group">
                            <label for="ovo_number">Nomor Telepon OVO <small class="text-muted">cth: 0812 3456 7890</small></label>
                            <input type="text" name="ovo_number" class="form-control">
                            <span class="invalid-feedback" role="alert">
                                <strong>Nomor telepon tidak valid</strong>
                            </span>
                        </div>
                        {{--<div class="file-drag-wrapper d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <i class="mdi mdi-image-filter mdi-36px"></i>
                                <div>Format gambar: .JPG .JPEG, .PNG, max 10 MB</div>
                            </div>
                            <img class="d-none" src="" style="width: auto;height: 100%;object-fit: cover;">
                        </div>--}}

                        {{--<div id="nomorRek" class="d-none">
                            --}}{{--<p class="mb-1 heading"></p>--}}{{--
                            <img src="" style="max-height: 30px;margin-bottom: 10px">
                            <p class="m-0 font-bold body"></p>
                        </div>--}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" disabled class="btn btn-primary" onclick="event.preventDefault();
                                                                               document.getElementById('bayarForm').submit()">Bayar</button>
                </div>
            </div>
        </div>
    </div>

@stop
@section('extra-script')
    <script>
        $(function() {
            var modal = $("#paymentConfirmModal");
            var form = modal.find("form");

            modal.on("show.bs.modal", function(e) {
                var btn = $(e.relatedTarget);
                var action = btn.data("action");
                var method = btn.data("method");
                var via = btn.data("via");
                var total = btn.data("total");
                var rekening = "";

                modal.find("label[for=method]").next().text(method);
                modal.find("label[for=via]").next().text(via);
                modal.find("label[for=total]").next().text(total);

                switch (method) {
                    case "OVO":
                        rekening = $(".m-ovo");
                        break;
                    case "BRI":
                        rekening = $(".m-bri");
                        break;
                    default:
                        rekening = $(".m-bca");
                }

                modal.find(".col-lg-6:last").append(rekening);
                form.attr("action", action);
            });

            modal.find(".btn-primary").on("click", function() {
                form.submit();
            });
        });

        $(function() {
            var form = $("#bayarForm");
            var modal = $("#bayarModal");
            var payment_method_select = $("select[name=payment_method]");
            var bank_account_select = $("select[name=bank_account]");

            modal.on("show.bs.modal", function(e) {
                var btn = $(e.relatedTarget);
                var id = btn.data("id");
                var amount = btn.data("amount");
                var amount_pretty = btn.data("amount-pretty");

                form.find("p.amount").text(amount_pretty);
                form.find("input[name=amount]").val(amount);
                form.find("input[name=setoran_id]").val(id);
                $(".ovo_number").hide();
            });

            modal.on("hidden.bs.modal", function(e) {
                var submitBtn = modal.find(".modal-footer .btn-primary");

                payment_method_select.val("").trigger("change");
                bank_account_select.val("").trigger("change");
                submitBtn.attr("disabled", "disabled");
                $("input[name=ovo_number]").removeClass("is-invalid");
            });

            payment_method_select.on("change", function(e) {
                var submitBtn = modal.find(".modal-footer .btn-primary");

                if (payment_method_select.val() != "" && bank_account_select.length != 0 && bank_account_select.val() != "") {
                    submitBtn.attr("disabled", false);
                }

                if (payment_method_select.val() == "OVO") {
                    payment_method_select.parent().next().hide();
                    $(".ovo_number").show();
                } else {
                    payment_method_select.parent().next().show();
                    $(".ovo_number").hide();
                }
            });

            $("input[name=ovo_number]").on("input", function(e) {
                var submitBtn = modal.find(".modal-footer .btn-primary");
                if (payment_method_select.val() != "" && $(this).val() != "" && $(this).val().length >= 10) {
                    $("input[name=ovo_number]").removeClass("is-invalid");
                    submitBtn.attr("disabled", false);
                } else {
                    $("input[name=ovo_number]").addClass("is-invalid");
                    submitBtn.attr("disabled", "disabled");
                }
            });

            bank_account_select.on("change", function(e) {
                var submitBtn = modal.find(".modal-footer .btn-primary");

                if (payment_method_select.val() != "" && bank_account_select.length != 0 && bank_account_select.val() != "") {
                    submitBtn.attr("disabled", false);
                }
            });
        });

        $(function() {
            var form = $("#bayarForm");
            var norek = $("#nomorRek");
            form.find("select").on("select2:select", function(e) {
                if (e.params.data.id === "BRI") {
                    norek.removeClass("d-none");
                    norek.find("img").attr("src", "http://gonigoni.id/assets/img/bri-logo.png");
                    norek.find("p.body").text("0633 01 023097 50 2 a.n. Firza Maulana Nasution");
                }

                if (e.params.data.id === "BCA") {
                    norek.removeClass("d-none");
                    norek.find("img").attr("src", "http://gonigoni.id/assets/img/bca-logo.png");
                    norek.find("p.body").text("8000762190 a.n. Firza Maulana Nasution");
                }

                if (e.params.data.id === "OVO") {
                    norek.removeClass("d-none");
                    norek.find("img").attr("src", "http://gonigoni.id/assets/img/ovo-logo.png");
                    norek.find("p.body").text("+62 822 73696930 a.n. Firza Maulana Nasution");
                }
            });
        });
    </script>
@stop
