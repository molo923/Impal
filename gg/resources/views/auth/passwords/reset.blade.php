@extends('layouts.matrix-auth')

@section('content')
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
            <div class="row">
                <div class="col-12">
                    <h3>Ubah Kata Sandi</h3>
                    <p>Untuk mengamankan akun anda, pastikan kata sandi anda:</p>
                    <ul>
                        <li>Minimal 8 karakter</li>
                        <li>Memiliki kombinasi huruf dan angka</li>
                    </ul>
                </div>
            </div>
            <div class="row m-t-20">
                <form class="col-12" method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <input id="email" type="hidden" class="form-control form-control-lg mb-2 @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="{{ __('Email Address') }}" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="password" type="password" class="form-control form-control-lg mb-2 @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Kata sandi baru') }}">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="{{ __('Ulangi kata sandi baru') }}">

                    <div class="row m-t-20 p-t-20">
                        <div class="col-12">
                            <button class="btn btn-info float-right" type="submit">Ubah Kata Sandi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
