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
                        <a href="{{ route('banksampah.pegawai-index') }}" class="btn btn-secondary mr-2"><i class="mdi mdi-arrow-left"></i> Kembali</a>
                        <div class="row mt-4">
                            <div class="col-md-7">
                                <form id="addPegawaiForm" class="form-horizontal" method="POST" action="{{ route('pegawai.store') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="type" class="col-sm-3 text-md-right control-label col-form-label">Tipe Pegawai</label>
                                        <div class="col-sm-9">
                                            <select name="type" placeholder="Pilih jenis pegawai..." class="select2 form-control @error('type') is-invalid @enderror custom-select" style="width: 100%; height:36px;">
                                                <option></option>
                                                <option value="back" {{ old('type') === 'back' ? 'selecetd' : '' }}>Back</option>
                                                <option value="front" {{ old('type') === 'front' ? 'selecetd' : '' }}>Front</option>
                                                <option value="driver" {{ old('type') === 'driver' ? 'selecetd' : '' }}>Driver</option>
                                            </select>
                                            @error('type')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 text-md-right control-label col-form-label">Nama lengkap</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="gender" class="col-sm-3 text-md-right control-label col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex align-items-center">
                                                <div class="custom-control custom-radio mr-3">
                                                    <input type="radio" {{ old('gender') === 'L' ? 'checked' : '' }} class="custom-control-input @error('gender') is-invalid @enderror" value="L" id="laki" name="gender">
                                                    <label class="custom-control-label" for="laki">Laki-laki</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" {{ old('gender') === 'P' ? 'checked' : '' }} class="custom-control-input @error('gender') is-invalid @enderror" value="P" id="perempuan" name="gender">
                                                    <label class="custom-control-label" for="perempuan">Perempuan</label>
                                                </div>
                                            </div>
                                            @error('gender')
                                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-3 text-md-right control-label col-form-label">Username</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" name="username">
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 text-md-right control-label col-form-label">Alamat email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 text-md-right control-label col-form-label">Kata sandi</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 text-md-right control-label col-form-label">Ulangi Kata sandi</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone_number" class="col-sm-3 text-md-right control-label col-form-label">Nomor telepon</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" name="phone_number">
                                            @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-3 text-md-right control-label col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" name="address">
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="city" class="col-sm-3 text-md-right control-label col-form-label">Kota/Kabupaten</label>
                                        <div class="col-sm-9">
                                            <select name="city" class="form-control @error('city') is-invalid @enderror select2" placeholder="Pilih kota...">
                                                <option value=""></option>
                                            </select>
                                            @error('city')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="districts" class="col-sm-3 text-md-right control-label col-form-label">Kecamatan</label>
                                        <div class="col-sm-9">
                                            <select disabled="disabled" name="districts" class="form-control @error('districts') is-invalid @enderror select2" placeholder="Pilih kecamatan...">
                                                <option value=""></option>
                                            </select>
                                            @error('districts')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="urban" class="col-sm-3 text-md-right control-label col-form-label">Kelurahan</label>
                                        <div class="col-sm-9">
                                            <select disabled="disabled" name="urban" class="form-control @error('urban') is-invalid @enderror select2" placeholder="Pilih kelurahan...">
                                                <option value=""></option>
                                            </select>
                                            @error('urban')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="postal_code" class="col-sm-3 text-md-right control-label col-form-label">Kode Pos</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" value="{{ old('postal_code') }}" name="postal_code">
                                            @error('postal_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body d-flex justify-content-end">
                            <a href="{{ route('banksampah.pegawai-index') }}" class="btn btn-secondary mr-2" data-dismiss="modal">Batal</a>
                            <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                                                                               document.getElementById('addPegawaiForm').submit()">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection
@section('extra-script')
    <script>
        $(function() {
            var addModal = $("#addPegawaiModal");
            var modal = $("#editPegawaiModal");
            modal.on("show.bs.modal", function(event) {
                var button = $(event.relatedTarget);
                var id = button.data("id");
                var pegawai_type = button.data("pegawai-type");

                modal.find("form").attr({
                    action: "{{ route('pegawai.update', '') }}/"+id,
                });

                modal.find("select").val(pegawai_type).trigger("change");

                modal.find(".form-group p").text(pegawai_type);
            });
            modal.find("select").trigger("select2:select");
            modal.find("select").on("select2:select", function() {
                console.log($(this).val() === modal.find(".form-group p").text());
                if ($(this).val() === "") {
                    modal.find("button[action=submit]").attr("disabled", true);
                } else if ($(this).val() === modal.find(".form-group p").text()) {
                    modal.find("button[action=submit]").attr("disabled", true);
                } else {
                    modal.find("button[action=submit]").attr("disabled", false);
                }
            });
            addModal.on("hidden.bs.modal", function(e) {
                addModal.find("input[type=text]").val("");
                addModal.find("input[type=email]").val("");
                addModal.find("input[type=password]").val("");
                addModal.find(".select2").val("");
            });
        });

        $(function() {
            var token = function() {
                return $.ajax({
                    type: "GET",
                    url: "https://x.rajaapi.com/poe"
                });
            };

            var selectCity = $(".select2[name=city]");
            var selectDistrics = $(".select2[name=districts]");
            var selectUrban = $(".select2[name=urban]");

            token().then(function (data) {
                $.ajax({
                    type: "GET",
                    url: "https://x.rajaapi.com/MeP7c5ne" + data.token + "/m/wilayah/kabupaten?idpropinsi=32",
                    success: function (data) {
                        if (data.code !== 404) {
                            var the_data = ["", ...data.data.map(function (item) {
                                return {
                                    id: item.name.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                                        return letter .toUpperCase();
                                    }),
                                    text: item.name.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                                        return letter.toUpperCase();
                                    }),
                                    city_id: item.id,
                                }
                            })];

                            selectCity.empty();
                            selectCity.select2({
                                placeholder: "Pilih kota...",
                                width: "100%",
                                data: the_data,
                            });
                            selectCity.trigger({
                                type: "select2:select",
                                params: {
                                    data: the_data[0]
                                }
                            });
                        }
                    },
                });
            });

            selectCity.on("select2:select", function (e) {
                selectDistrics.attr("disabled", false);
                selectDistrics.select2({
                    width: "100%",
                    placeholder: "Memuat kecamatan...",
                });
                token().then(function (data) {
                    $.ajax({
                        type: "GET",
                        url: "https://x.rajaapi.com/MeP7c5ne" + data.token + "/m/wilayah/kecamatan?idkabupaten=" + e.params.data.city_id,
                        success: function (data) {
                            if (data.code !== 404) {
                                var the_data = ["",...data.data.map(function (item) {
                                    return {
                                        id: item.name.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                                            return letter.toUpperCase();
                                        }),
                                        text: item.name.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                                            return letter.toUpperCase();
                                        }),
                                        districts_id: item.id,
                                    }
                                })];

                                selectDistrics.empty();
                                selectDistrics.select2({
                                    placeholder: "Pilih kecamatan...",
                                    data: the_data,
                                });
                                selectDistrics.trigger({
                                    type: "select2:select",
                                    params: {
                                        data: the_data[0]
                                    }
                                });
                            }
                        },
                    });
                });
            });

            selectDistrics.on("select2:select", function(e) {
                selectUrban.attr("disabled", false);
                selectUrban.select2({
                    width: "100%",
                    placeholder: "Memuat kelurahan...",
                });
                token().then(function (data) {
                    $.ajax({
                        type: 'GET',
                        url: "https://x.rajaapi.com/MeP7c5ne" + data.token + "/m/wilayah/kelurahan?idkecamatan=" + e.params.data.districts_id,
                        success: function (data) {
                            if (data.code !== 404) {
                                var the_data = ["",...data.data.map(function (item) {
                                    return {
                                        id: item.name.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                                            return letter.toUpperCase();
                                        }),
                                        text: item.name.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                                            return letter.toUpperCase();
                                        }),
                                        districts_id: item.id,
                                    }
                                })];

                                selectUrban.empty();
                                selectUrban.select2({
                                    placeholder: "Pilih kelurahan...",
                                    data: the_data,
                                });
                                selectUrban.trigger({
                                    type: "select2:select",
                                    params: {
                                        data: the_data[0]
                                    }
                                });
                            }
                        },
                    });
                });
            });
        });
    </script>
@endsection
