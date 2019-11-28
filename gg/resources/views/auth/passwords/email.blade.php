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
            <div>
                <div class="text-center">
                    <span>Masukkan alamat email anda dan kami akan mengirimkan instruksi untuk memulihkan kata sandi anda.</span>
                </div>
                <div class="row m-t-20">
                    <!-- Form -->
                    <form class="col-12" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <!-- email -->
                        <input type="text" class="form-control @error('email') is-invalid @enderror form-control-lg" placeholder="Alamat email" name="email" value="{{ $email ?? old('email') }}" autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <!-- pwd -->
                        <div class="row m-t-20 p-t-20">
                            <div class="col-12">
                                <a class="btn btn-secondary" href="{{ route('login') }}">Kembali ke halaman masuk</a>
                                <button class="btn btn-info float-right" type="submit">Pulihkan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
