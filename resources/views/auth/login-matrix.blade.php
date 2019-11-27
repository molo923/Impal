@extends('layouts.matrix-auth')

@section('content')
        <login-component
            login-route="{{ route('login') }}"
            password-request-route="{{ route('password.request') }}"
            register-route="{{ route('banksampah.register') }}"
            resend-email-route="{{ route('verification.resend') }}"
            ggn-icon="{{ asset('gonigoni_icon.png') }}"
            ggn-text="{{ asset('gonigoni_text.png') }}"
        ></login-component>
@stop

{{--@section('content')
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-light">
        <div class="auth-box bg-light">
            <div class="text-center p-t-20 p-b-20">
                <span>
                    <img style="width: 60px" src="{{ asset('gonigoni_icon.png') }}" alt="logo" />
                </span>
                <span class="db">
                    <img style="width: 160px" src="{{ asset('gonigoni_text.png') }}" alt="logo" />
                </span>
            </div>
            @if (session('email') !== null)
                <form id="resend-email" class="d-none" method="POST" action="{{ route('verification.resend') }}">
                    @csrf

                    <input type="hidden" name="email" value="{{ session('email') }}">
                </form>
                <div class="alert alert-warning">
                    <p class="mb-1">Akun anda harus diverifikasi untuk masuk.</p>
                    <p class="mb-1">Link verifikasi email telah dikirim ke {{ session('email') }}.</p>
                    <p class="mb-1">Jika anda tidak menerima email verifikasi,<br> <a href="#" onclick="event.preventDefault();
                        event.stopPropagation();document.getElementById('resend-email').submit()">Klik disini</a> untuk mengirim ulang.</p>
                </div>
            @endif

            @if (session('verified') !== null)
                <div class="alert alert-info">
                    <p class="mb-1">Selamat anda telah memverifikasi akun anda.</p>
                    <p class="mb-1">Akun anda belum aktif, silahkan menunggu untuk verifikasi dari Administrator.</p>
                </div>
            @endif

            @if (session('pegawai_verified') !== null)
                <div class="alert alert-info">
                    <p class="mb-1">Selamat anda telah memverifikasi akun anda.</p>
                </div>
            @endif
            <div id="loginform">
            <!-- Form -->
                <form class="form-horizontal m-t-20" id="loginform" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row p-b-30">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <input type="text" name="login" value="{{ old('username') ?: old('email') }}" class="form-control {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }} form-control-lg" placeholder="Username atau alamat email" aria-label="Username" aria-describedby="basic-addon1" required="">

                                @if ($errors->has('username') || $errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror form-control-lg" placeholder="Kata sandi" aria-label="Password" aria-describedby="basic-addon1" required="">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="custom-control-label" style="margin-top: 1px" for="remember">
                                        Ingat saya
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <div>
                                    <a class="btn btn-secondary" href="{{ route('password.request') }}"><i class="fa fa-lock m-r-5"></i> Lupa kata sandi?</a>
                                    <button class="btn btn-info float-right" type="submit">Masuk</button>
                                </div>
                            </div>
                            <p class="text-center">Belum memiliki akun? <a href="{{ route('banksampah.register') }}">Daftar disini</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection--}}
