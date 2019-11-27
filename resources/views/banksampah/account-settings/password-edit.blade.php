@extends('layouts.account-settings')

@section('as-content')
    <form action="{{ route('banksampah.password.update') }}" class="col-lg-8" method="POST">
        @method('PUT')
        @csrf

        <div class="form-group row">
            <label for="password_old" class="col-md-4 col-form-label">Kata Sandi Lama</label>

            <div class="col-md-8">
                <input id="password_old" type="password" class="form-control @error('password_old') is-invalid @enderror" name="password_old" autocomplete="off">

                @error('password_old')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label">Kata Sandi Baru</label>

            <div class="col-md-8">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="off">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password_confirmation" class="col-md-4 col-form-label">Ulangi Kata Sandi Baru</label>

            <div class="col-md-8">
                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="off">

                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-8 offset-md-4">
                <button class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </form>
@endsection
