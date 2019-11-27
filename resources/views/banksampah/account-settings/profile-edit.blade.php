@extends('layouts.account-settings')

@section('as-content')

    <form action="{{ route('banksampah.profile.update') }}" class="col-lg-8" method="POST">
        @method('PUT')
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label">{{ __('Nama Bank Sampah') }}</label>

            <div class="col-md-8">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? auth()->user()->name }}" autocomplete="off">

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        {{--<div class="form-group row">
            <label for="address" class="col-md-4 col-form-label">{{ __('Alamat Bank Sampah') }}</label>

            <div class="col-md-8">
                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? auth()->user()->alamat->address }}" autocomplete="off">

                @error('address')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
        </div>--}}
        {{--<div class="form-group row">
            <label for="username" class="col-md-4 col-form-label">{{ __('Nama Pengguna') }}</label>

            <div class="col-md-8">
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') ?? auth()->user()->username }}" autocomplete="off">

                @error('username')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label">{{ __('Alamat E-mail') }}</label>

            <div class="col-md-8">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? auth()->user()->email }}" autocomplete="off">

                @error('email')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
        </div>--}}
        <div class="form-group row">
            <div class="col-md-8 offset-md-4">
                <button class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </form>

@endsection
