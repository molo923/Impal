@extends('layouts.account-settings')

@section('as-content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Akun Bank</h4>
        <button data-target="#addBankAccountModal" data-toggle="modal" class="btn btn-primary"><i class="mdi mdi-plus"></i> Tambah Akun Bank</button>
    </div>

    <div>
        @if ($bankaccounts->isEmpty())
            <div class="py-4">
                <h4 class="text-muted font-bold text-center my-5">Belum ada akun bank.</h4>
            </div>
        @else
            @foreach ($bankaccounts as $bankaccount)
                <div class="card shadow-sm border">
                    <div class="card-body p-3">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="mb-1 font-medium">{{ $bankaccount->bank->name }}</p>
                                <p class="mb-1 font-medium">{{ $bankaccount->number }}</p>
                                <p class="mb-1 font-medium">{{ $bankaccount->name }}</p>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-info" data-bankaccount="{{ $bankaccount->toJson() }}" data-target="#editBankAccountModal" data-toggle="modal">Edit</button>
                                <button class="btn btn-sm btn-danger" data-bankaccount="{{ $bankaccount->toJson() }}" data-id="{{ $bankaccount->id }}" data-target="#deleteBankAccountConfirmModal" data-toggle="modal">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div id="deleteBankAccountConfirmModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus Akun Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p></p>
                    <form id="deleteBankAccountForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <div id="editBankAccountModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Akun Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editBankAccountForm" action="" method="POST">
                        @csrf
                        @method('PUT')

                        <p>Nomor dan nama rekening harus sesuai dengan buku tabungan.</p>
                        <div class="form-group">
                            <label for="bank">Nama Bank</label>
                            <select name="bank_id" class="select2 form-control @error('bank_id') is-invalid @enderror" placeholder="Pilih bank...">
                                <option></option>
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                @endforeach
                            </select>

                            @error('bank')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="number">Nomor Rekening</label>
                            <input type="number" class="form-control p-t-10 p-b-10 @error('number') is-invalid @enderror" name="number">

                            @error('number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Nama Pemilik Rekening</label>
                            <input type="text" class="form-control p-t-10 p-b-10 @error('name') is-invalid @enderror" name="name">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" data-target="#editBankAccountConfirmModal" data-toggle="modal" data-dismiss="modal">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>

    <div id="editBankAccountConfirmModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Perubahan Akun Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-target="#editBankAccountModal" data-toggle="modal" data-dismiss="modal">Ubah</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>

    <div id="addBankAccountModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Akun Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addBankAccountForm" action="{{ route('banksampah.bank-account.store') }}" method="POST">
                        @csrf
                        <p>Nomor Rekening dan Nama Pemilik Rekening harus sesuai dengan buku tabungan.</p>
                        <div class="form-group">
                            <label for="bank">Nama Bank</label>
                            <select name="bank_id" class="select2 form-control @error('bank_id') is-invalid @enderror" placeholder="Pilih bank...">
                                <option></option>
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                @endforeach
                            </select>

                            @error('bank')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="number">Nomor Rekening</label>
                            <input type="number" class="form-control p-t-10 p-b-10 @error('number') is-invalid @enderror" name="number">

                            @error('number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Nama Pemilik Rekening</label>
                            <input type="text" class="form-control p-t-10 p-b-10 @error('name') is-invalid @enderror" name="name">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" disabled class="btn btn-primary" data-target="#addBankAccountConfirmModal" data-toggle="modal" data-dismiss="modal">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>

    <div id="addBankAccountConfirmModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Akun Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-target="#addBankAccountModal" data-toggle="modal" data-dismiss="modal">Ubah</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('extra-script')
    <script>
        $(function() {
            var modal = $("#addBankAccountModal");
            var editModal = $("#editBankAccountModal");
            var modalConfirm = $("#addBankAccountConfirmModal");
            var deleteModalConfirm = $("#deleteBankAccountConfirmModal");
            var editModalConfirm = $("#editBankAccountConfirmModal");

            var form = $("#addBankAccountForm");
            var formDelete = $("#deleteBankAccountForm");
            var formEdit = $("#editBankAccountForm");

            var select = modal.find("select");
            var inputNumber = modal.find("input[name=number]");
            var inputName = modal.find("input[name=name]");
            var submit = modal.find("button[type=submit]");
            var confirm = modalConfirm.find("button[type=submit]");

            var deleteConfirm = deleteModalConfirm.find("button[type=submit]");

            var selectE = editModal.find("select");
            var inputNumberE = editModal.find("input[name=number]");
            var inputNameE = editModal.find("input[name=name]");
            var submitE = editModal.find("button[type=submit]");
            var editConfirm = editModalConfirm.find("button[type=submit]");

            var datas = {};

            function resetFields() {
                select.val("").trigger("change");
                inputNumber.val("");
                inputName.val("");
            }

            modal.on("hidden.bs.modal", function(e) {
                resetFields();
            });

            submit.on("click", function(e) {
                datas = {
                    bank_id: select.val(),
                    number: inputNumber.val(),
                    name: inputName.val(),
                };
            });

            confirm.on("click", function() {
                $.ajax({
                    method: "POST",
                    url: "{!! route('banksampah.bank-account.store') !!}",
                    data: datas,
                    success: function(e) {
                        location.reload();
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            });

            editConfirm.on("click", function() {
                if (selectE.val() !== "" && inputNameE.val() !== "" && inputNumberE.val() !== "") {
                    formEdit.submit();
                }
            });

            deleteModalConfirm.on("show.bs.modal", function(e) {
                var btn = $(e.relatedTarget);
                var id = btn.data("id");
                var bankaccount = btn.data("bankaccount");
                var body = $(this).find(".modal-body p");

                formDelete.attr("action", "{{ route('banksampah.bank-account.destroy', '') }}/"+id);

                body.text("Anda akan menghapus "+bankaccount.bank.name+
                    " "+bankaccount.number+
                    " a/n "+bankaccount.name+
                    " pada Akun Bank anda.");
            });

            deleteConfirm.on("click", function() {
                formDelete.submit();
            });

            modalConfirm.on("show.bs.modal", function(e) {
                $(this).find(".modal-body")
                    .text("Anda akan menambahkan "+select.select2('data')[0].text+
                        " "+inputNumber.val()+
                        " a/n "+inputName.val()+
                        " pada Akun Bank anda.");
            });

            editModalConfirm.on("show.bs.modal", function(e) {
                var btn = $(e.relatedTarget);
                var bankaccount = btn.data("bankaccount");

                $(this).find(".modal-body")
                    .text("Anda akan mengubah "+bankaccount.bank.name+
                        " "+bankaccount.number+
                        " a/n "+bankaccount.name+
                        " pada Akun Bank anda.");

                $(this).find(".modal-footer button[type=button]").attr("data-bankaccount", JSON.stringify(bankaccount));
            });

            editModal.on("show.bs.modal", function(e) {
                var btn = $(e.relatedTarget);
                var bankaccount = btn.data("bankaccount");

                formEdit.attr("action", "{{ route('banksampah.bank-account.update', '') }}/"+bankaccount.id);
                selectE.val(bankaccount.bank_id).trigger("change");
                inputNumberE.val(bankaccount.number);
                inputNameE.val(bankaccount.name);
                submitE.attr("data-bankaccount", JSON.stringify(bankaccount));

                checkFormsE();
            });

            function checkForms() {
                submit.attr("disabled", "disabled");
                if (select.val() !== "" && inputName.val() !== "" && inputNumber.val() !== "") {
                    submit.attr("disabled", false);
                }
            }

            function checkFormsE() {
                if (selectE.val() !== "" && inputNameE.val() !== "" && inputNumberE.val() !== "") {
                    submitE.attr("disabled", false);
                } else {
                    submitE.attr("disabled", "disabled");
                }
            }

            select.on("change", function () {
                checkForms();
            });

            inputNumber.on("keyup", function() {
                checkForms();
            });

            inputName.on("keyup", function() {
                checkForms();
            });

            selectE.on("change", function () {
                checkFormsE();
            });

            inputNumberE.on("keyup", function() {
                checkFormsE();
            });

            inputNameE.on("keyup", function() {
                checkFormsE();
            });
        })
    </script>
@stop
