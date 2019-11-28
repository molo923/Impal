@extends('layouts.account-settings')

@section('as-content')
    <form action="{{ route('banksampah.account.update') }}" class="col-lg-8" method="POST">
        @method('PUT')
        @csrf

        <div class="form-group row">
            <label for="username" class="col-md-4 col-form-label">Username</label>

            <div class="col-md-8">
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') ?? (auth()->user()->username) }}" autocomplete="off">

                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label">Alamat Email</label>

            <div class="col-md-8">
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? (auth()->user()->email) }}" autocomplete="off">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 col-form-label">Nomor Telepon</label>

            <div class="col-md-8">
                <input readonly type="text" class="form-control" value="{{ (auth()->user()->phone_number) }}">
                <small>Jika ingin mengubah nomor telepon, harap menghubungi email: team.gonigoni@gmail.com</small>
            </div>
        </div>



        <div class="form-group row">
            <div class="col-md-8 offset-md-4">
                <button class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </form>
@endsection
