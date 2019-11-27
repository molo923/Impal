@extends('layouts.matrix-auth')

@section('content')
    <div class="d-flex no-block justify-content-center align-items-center bg-light row" style="min-height: 100vh">
        <div class="bg-light col-lg-4 col-md-8 col-sm-8 mx-3">
            <div>
                <div class="text-center p-b-20 pt-4">
                    <span>
                        <img style="width: 60px" src="{{ asset('gonigoni_icon.png') }}" alt="logo" />
                    </span>
                    <span class="db">
                        <img style="width: 160px" src="{{ asset('gonigoni_text.png') }}" alt="logo" />
                    </span>
                </div>
                <!-- Form -->
                <register-component
                    register-route="{{ route('banksampah.register') }}"
                    login-route="{{ route('login') }}"
                    ></register-component>
                {{--<form id="register" class="form-horizontal m-t-20 mb-4 shadow-none" method="POST" action="{{ route('banksampah.register') }}">
                    @csrf

                    <ul>
                        <li><a href="#step-1">Detail Akun</a></li>
                        <li><a href="#step-2">Detail Bank Sampah</a></li>
                    </ul>

                    <div>
                        <div id="step-1" class="bg-light p-0 mt-4">
                            <div class="row pb-3">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control form-control-lg @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" autofocus required>

                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @else
                                            <small class="font-medium">Username minimal 5 karakter, huruf dan angka.</small>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Alamat Email" aria-label="Alamat Email" aria-describedby="basic-addon1" required>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="Kata Sandi" aria-label="Kata Sandi" aria-describedby="basic-addon1" required>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @else
                                            <small class="font-medium">Kata sandi minimal 8 karakter dan harus memiliki kombinasi huruf dan angka.</small>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="password" class="form-control form-control-lg" placeholder="Ulangi Kata Sandi" name="password_confirmation" aria-label="Ulangi Kata Sandi" aria-describedby="basic-addon1" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="step-2" class="bg-light p-0 mt-4">
                            <div class="row pb-3">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control form-control-lg @error('banksampahName') is-invalid @enderror" name="banksampahName" value="{{ old('banksampahName') }}" placeholder="Nama Bank Sampah" aria-label="Nama Bank Sampah" aria-describedby="basic-addon1" autofocus required>

                                        @error('banksampahName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control form-control-lg @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" placeholder="Nomor Telepon" aria-label="Nomor Telepon" aria-describedby="basic-addon1" autofocus required>

                                        @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @else
                                            <small class="font-medium">Nomor minimal 10 angka.</small>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control form-control-lg @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" placeholder="Alamat Bank Sampah" aria-label="Alamat Bank Sampah" aria-describedby="basic-addon1" autofocus required>

                                        @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <select name="city" class="form-control form-control-lg @error('city') is-invalid @enderror select2" placeholder="Pilih kota...">
                                            <option value=""></option>
                                            --}}{{--@foreach ($kotas as $kota)
                                                <option value="{{ ucwords(strtolower($kota->name)) }}" data-id="{{ $kota->id }}">{{ ucwords(strtolower($kota->name)) }}</option>
                                            @endforeach--}}{{--
                                        </select>
                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <select disabled="disabled" name="districs" class="form-control form-control-lg @error('districs') is-invalid @enderror select2" placeholder="Pilih kecamatan...">
                                            <option value=""></option>
                                        </select>
                                        @error('districs')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <select disabled="disabled" name="urban" class="form-control form-control-lg @error('urban') is-invalid @enderror select2" placeholder="Pilih kelurahan...">
                                            <option value=""></option>
                                        </select>
                                        @error('urban')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control form-control-lg @error('postal_code') is-invalid @enderror" name="postal_code" placeholder="Kode pos">
                                        @error('postal_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <p class="mb-1">Dengan mengklik "Daftar" maka saya telah menyetujui <a href="http://gonigoni.id/terms.html" target="_blank">Aturan & Kebijakan</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>--}}

            </div>
        </div>
    </div>
@endsection

{{--@section('extra-script')
    <script>
        $(function() {
            var form = $("#register");
            form.smartWizard({
                useURLhash: false,
                toolbarSettings: {
                    toolbarPosition: 'bottom', // none, top, bottom, both
                    toolbarButtonPosition: 'right', // left, right
                    showNextButton: true, // show/hide a Next button
                    showPreviousButton: true, // show/hide a Previous button
                    toolbarExtraButtons: [
                        $('<button></button>').text('Daftar')
                            .addClass('btn btn-info btn-done')
                            .on('click', function(){
                                form.find("button.d-none").submit();
                            })
                    ]
                },
                lang: {  // Language variables
                    next: 'Selanjutnya',
                    previous: 'Kembali'
                },
            });
        });
        $(function() {
            var form = $("#register");
            var username = form.find("input[name=username]");
            var email = form.find("input[name=email]");
            var password = form.find("input[name=password]");
            var cPassword = form.find("input[name=password_confirmation]");
            var namaBanksampah = form.find("input[name=banksampahName]");
            var phoneNumber = form.find("input[name=phone_number]");
            var address = form.find("input[name=alamat]");
            var city = form.find("select[name=city]");
            var districs = form.find("select[name=districs]");
            var urban = form.find("select[name=urban]");
            var postalCode = form.find("input[name=postal_code]");
            var secondStepAnchor = form.find(".step-anchor .nav-item:nth-child(2)");

            var nextBtn = form.find(".sw-btn-next");
            var prevBtn = form.find(".sw-btn-prev");
            var doneBtn = form.find(".btn-done");

            nextBtn.attr("disabled", "disabled");
            doneBtn.attr("disabled", "disabled");

            function checkFirstStepForm() {
                if(username.val() !== "" && email.val() !== "" && password.val() !== "" && cPassword.val() !== "") {
                    nextBtn.attr("disabled", false);
                } else {
                    nextBtn.attr("disabled", "disabled");
                    secondStepAnchor.removeClass("done");
                    doneBtn.attr("disabled", "disabled");
                }
            }

            function checkSecondStepForm() {
                if(namaBanksampah.val() !== ""
                    && phoneNumber.val() !== ""
                    && address.val() !== ""
                    && city.val() !== ""
                    && districs.val() !== ""
                    && urban.val() !== ""
                    && postalCode.val() !== "") {
                    doneBtn.attr("disabled", false);
                } else {
                    doneBtn.attr("disabled", "disabled");
                }
            }

            function checkAllForm() {
                if(username.val() !== ""
                    && email.val() !== ""
                    && password.val() !== ""
                    && cPassword.val() !== ""
                    && namaBanksampah.val() !== ""
                    && phoneNumber.val() !== ""
                    && address.val() !== ""
                    && city.val() !== ""
                    && districs.val() !== ""
                    && urban.val() !== ""
                    && postalCode.val() !== "") {
                    doneBtn.attr("disabled", false);
                } else {
                    doneBtn.attr("disabled", "disabled");
                }
            }

            username.on("input", function(e) {
                checkFirstStepForm();
                checkAllForm();
            });

            email.on("input", function(e) {
                checkFirstStepForm();
                checkAllForm();
            });

            password.on("input", function(e) {
                checkFirstStepForm();
                checkAllForm();
            });

            cPassword.on("input", function(e) {
                checkFirstStepForm();
                checkAllForm();
            });

            namaBanksampah.on("input", function(e) {
                checkSecondStepForm();
                checkAllForm();
            });

            phoneNumber.on("input", function(e) {
                checkSecondStepForm();
                checkAllForm();
            });

            address.on("input", function(e) {
                checkSecondStepForm();
                checkAllForm();
            });

            postalCode.on("input", function(e) {
                checkSecondStepForm();
                checkAllForm();
            });

            city.on("select2:select", function(e) {
                checkSecondStepForm();
                checkAllForm();
            });

            districs.on("select2:select", function(e) {
                checkSecondStepForm();
                checkAllForm();
            });

            urban.on("select2:select", function(e) {
                checkSecondStepForm();
                checkAllForm();
            });

            form.on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {

            });

            $(".btn-toolbar.sw-toolbar.sw-toolbar-bottom.justify-content-end").addClass("p-0");
        });

        $(function() {
            var token = function() {
                return $.ajax({
                    type: "GET",
                    url: "https://x.rajaapi.com/poe"
                });
            };

            var selectCity = $(".select2[name=city]");
            var selectDistrics = $(".select2[name=districs]");
            var selectUrban = $(".select2[name=urban]");

            token().then(function (data) {
                $.ajax({
                    type: "GET",
                    url: "https://x.rajaapi.com/MeP7c5ne" + data.token + "/m/wilayah/kabupaten?idpropinsi=32",
                    success: function (data) {
                        var the_data = ["",...data.data.map(function (item) {
                            return {
                                id: item.name.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                                    return letter.toUpperCase();
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
                            data: the_data
                        });
                        selectCity.trigger({
                            type: "select2:select",
                            params: {
                                data: the_data[0]
                            }
                        });
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
                            var the_data = ["",...data.data.map(function (item) {
                                return {
                                    id: item.name.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                                        return letter.toUpperCase();
                                    }),
                                    text: item.name.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                                        return letter.toUpperCase();
                                    }),
                                    districs_id: item.id,
                                }
                            })];

                            selectDistrics.empty();
                            selectDistrics.select2({
                                placeholder: "Pilih kecamatan...",
                                data: the_data
                            });
                            selectDistrics.trigger({
                                type: "select2:select",
                                params: {
                                    data: the_data[0]
                                }
                            });
                        },
                    });
                });
            });

            selectDistrics.on("select2:select", function(e) {

                selectUrban.attr("disabled", false);
                selectUrban.select2({
                    placeholder: "Memuat kelurahan...",
                });
                token().then(function (data) {
                    $.ajax({
                        type: 'GET',
                        url: "https://x.rajaapi.com/MeP7c5ne" + data.token + "/m/wilayah/kelurahan?idkecamatan=" + e.params.data.districs_id,
                        success: function (data) {
                            selectUrban.empty();
                            selectUrban.select2({
                                data: data.data.map(function (item) {
                                    return {
                                        id: item.name.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                                            return letter.toUpperCase();
                                        }),
                                        text: item.name.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                                            return letter.toUpperCase();
                                        }),
                                    }
                                })
                            });
                        },
                    });
                });
            });
        });
    </script>
@endsection--}}
