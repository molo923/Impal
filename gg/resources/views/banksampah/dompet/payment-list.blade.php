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
                        <a href="{{ route('dompet.index') }}" class="btn btn-secondary mb-4"><i class="mdi mdi-arrow-left"></i> Kembali</a>
                        @if ($setorans->isEmpty())
                            <div class="d-flex align-items-center justify-content-center">
                                <h4 class="text-center text-muted font-bold my-5 py-5">Belum ada pembayaran.</h4>
                            </div>
                        @else
                            @foreach ($setorans as $setoran)
                                <div class="card shadow-sm border">
                                    <div class="card-body d-flex flex-md-row flex-column">
                                        <div class="flex-grow-1">
                                            <div class="mb-3">
                                                <h4>Setoran {{ $setoran->id_pretty }}</h4>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-1">Nasabah: <span class="font-bold">{{ $setoran->nasabah->name }}</span></div>
                                                    <div class="mb-1">Total: <span class="font-bold">{{ $setoran->price_total_nett_rp }}</span></div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-1">Tanggal Transaksi: <span class="font-bold">{{ Carbon\Carbon::create($setoran->setoranPayment->date_placed)->isoFormat('DD MMMM YYYY') }}</span></div>
                                                    <div>Metode Pembayaran: <span class="font-medium">Transfer Manual </span><span class="font-bold">{{ $setoran->setoranPayment->payment_method }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-md-0 mt-3">
                                            <button class="btn btn-outline-info btn-block" data-id="{{ $setoran->setoranPayment->id }}" data-toggle="modal" data-target="#inputTransferModal">Pilih Akun Bank</button>
                                            <button class="btn btn-outline-info btn-block" data-method="{{ $setoran->setoranPayment->payment_method }}" data-toggle="modal" data-target="#norekModal">Nomor Rekening</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="norekModal" class="modal fade">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nomor Rekening</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="nomorRek" class="d-none">
                        {{--<p class="mb-1 heading"></p>--}}
                        <img src="" style="max-height: 60px" class="mb-4">
                        <h5 class="m-0 font-medium body"></h5>
                        <h5 class="m-0 font-medium body2"></h5>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div id="inputTransferModal" class="modal fade">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Akun Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{--<p>Pastikan bukti pembayaran menampilkan:</p>
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="font-bold mb-1">- Tanggal/Waktu Transfer</p>
                            <p class="font-bold">- Status Sukses</p>
                        </div>
                        <div class="col-lg-6">
                            <p class="font-bold mb-1">- Detail Penerima</p>
                            <p class="font-bold">- Jumlah Transfer</p>
                        </div>
                    </div>
                    <button id="deleteImage" class="btn btn-sm btn-danger mb-2 d-none">Hapus Gambar</button>--}}
                    @if ($bankaccounts->isEmpty())
                        <h5 class="font-bold text-muted text-center my-5">Anda belum memiliki Akun Bank. <a href="{{ route('banksampah.bank-account') }}">Tambah terlebih dahulu disini.</a></h5>
                    @else
                        <form id="inputProofForm" action="" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="transfer_number">Akun Bank</label>
                                <select name="bank_account" class="select2 form-control" placeholder="Pilih akun bank...">
                                    <option value=""></option>
                                    @foreach ($bankaccounts as $bankaccount)
                                        <option value="{{ $bankaccount->id }}">{{ $bankaccount->bank->name . " " . $bankaccount->number . " a/n " . $bankaccount->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--<div class="file-drag-wrapper d-flex align-items-center justify-content-center">
                                <div class="text-center">
                                    <i class="mdi mdi-image-filter mdi-36px"></i>
                                    <div>Format gambar: .JPG .JPEG, .PNG, max 10 MB</div>
                                </div>
                                <img class="d-none" src="" style="width: auto;height: 100%;object-fit: cover;">
                            </div>--}}
                        </form>
                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" {{ $bankaccounts->isEmpty() ? 'disabled' : '' }} class="btn btn-primary" onclick="event.preventDefault();
                                                                               document.getElementById('inputProofForm').submit()">Selesai</button>
                </div>
            </div>
        </div>
    </div>

    {{--<div id="uploadProofModal" class="modal fade">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Unggah Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Pastikan bukti pembayaran menampilkan:</p>
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="font-bold mb-1">- Tanggal/Waktu Transfer</p>
                            <p class="font-bold">- Status Sukses</p>
                        </div>
                        <div class="col-lg-6">
                            <p class="font-bold mb-1">- Detail Penerima</p>
                            <p class="font-bold">- Jumlah Transfer</p>
                        </div>
                    </div>
                    <button id="deleteImage" class="btn btn-sm btn-danger mb-2 d-none">Hapus Gambar</button>
                    <form id="uploadProofForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="file-drag-wrapper d-flex align-items-center justify-content-center">
                            <input type="file" name="file" class="file-drag">
                            <div class="text-center">
                                <i class="mdi mdi-image-filter mdi-36px"></i>
                                <div>Format gambar: .JPG .JPEG, .PNG, max 10 MB</div>
                            </div>
                            <img class="d-none" src="" style="width: auto;height: 100%;object-fit: cover;">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                                                                               document.getElementById('uploadProofForm').submit()">Unggah Bukti Pembayaran</button>
                </div>
            </div>
        </div>
    </div>--}}

@stop
@section('extra-script')
    <script>
        /*function readFile(input) {
            var formUPF = $("#uploadProofForm");
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    formUPF.find("img").removeClass("d-none").attr("src", e.target.result);
                    $("#deleteImage").removeClass("d-none");
                }

                reader.readAsDataURL(input.files[0]);
            }
        }*/

        $(function() {
            var form = $("#inputProofForm");

            $("#inputTransferModal").on("show.bs.modal", function(e) {
                var btn = $(e.relatedTarget);
                var id = btn.data("id");

                form.attr("action", "{{ route('dompet.input-transfer-number', '') }}/" + id);
            });

            /*$(".file-drag").change(function(){
                readFile(this);

                form.find(".text-center").hide();
            });

            $("#deleteImage").on("click", function (e) {
                e.preventDefault();
                e.stopPropagation();

                $("#deleteImage").addClass("d-none");
                form.find(".text-center").show();
                form.find("img").addClass("d-none").attr("src", "");
                form[0].reset();
            });*/
        });

        $(function() {
            var modal = $("#norekModal");
            var norek = $("#nomorRek");
            modal.on("show.bs.modal", function(e) {
                var btn = $(e.relatedTarget);
                var method = btn.data("method");
                if (method === "BRI") {
                    norek.removeClass("d-none");
                    norek.find("img").attr("src", "http://gonigoni.id/assets/img/bri-logo.png");
                    norek.find("h5.body").text("0633 01 023097 502");
                    norek.find("h5.body2").text("a.n. Firza Maulana Nasution");
                }

                if (method === "BCA") {
                    norek.removeClass("d-none");
                    norek.find("img").attr("src", "http://gonigoni.id/assets/img/bca-logo.png");
                    norek.find("h5.body").text("8000762190");
                    norek.find("h5.body2").text("a.n. Firza Maulana Nasution");
                }

                if (method === "OVO") {
                    norek.removeClass("d-none");
                    norek.find("img").attr("src", "http://gonigoni.id/assets/img/ovo-logo.png");
                    norek.find("h5.body").text("+62 822 73696930");
                    norek.find("h5.body2").text("a.n. Firza Maulana Nasution");
                }
            });
        });
    </script>
@stop

