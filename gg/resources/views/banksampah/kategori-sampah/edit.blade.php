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
                        <div class="row">
                            <div class="col-lg-6">
                                <form id="editKategoriSampahForm" class="form-horizontal" method="POST" action="{{ route('kategori-sampah.update', $kategorisampah->id) }}">
                                    @method('put')
                                    @csrf

                                    <div class="form-group row">
                                        <label for="code" class="col-md-3 text-lg-right control-label col-form-label">Kode Sampah</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') ?? $kategorisampah->code }}" name="code">
                                            @error('code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-3 text-lg-right control-label col-form-label">Golongan</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $kategorisampah->name }}" name="name">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="price" class="col-md-3 text-lg-right control-label col-form-label">Harga Sampah</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control @error('price') is-invalid @enderror" value="{{ $kategorisampah->price }}" name="price">
                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-md-3 text-lg-right control-label col-form-label">Deskripsi (Opsional)</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="{{ $kategorisampah->description }}" name="description">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jenissampah_id" class="col-md-3 text-lg-right control-label col-form-label">Jenis Sampah</label>
                                        <div class="col-md-9">
                                            <select name="jenissampah_id" placeholder="Pilih jenis sampah..." class="select2 form-control @error('jenissampah_id') is-invalid @enderror custom-select" style="width: 100%; height:36px;">
                                                <option></option>
                                                @foreach($jenissampahs as $jenissampah)
                                                    <option value="{{ $jenissampah->id }}" {{ ($jenissampah->id === $kategorisampah->jenissampah_id ? 'selected' : '') }}>{{ $jenissampah->type }}</option>
                                                @endforeach
                                            </select>
                                            @error('jenissampah_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status_id" class="col-md-3 text-lg-right control-label col-form-label">Status Sampah</label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            <select name="status_id" placeholder="Pilih status..." class="select2 form-control @error('status_id') is-invalid @enderror custom-select" style="width: 100%; height:36px;">
                                                <option></option>
                                                @foreach($statuses->except([1,2,3,4]) as $status)
                                                    <option value="{{ $status->id }}" {{ ($status->id === $kategorisampah->status_id ? 'selected' : '') }}>{{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('status_id')
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
                            <a href="{{ route('kategori-sampah.index') }}" class="btn btn-secondary mr-2">Batal</a>
                            <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                                                                                   document.getElementById('editKategoriSampahForm').submit()">Edit</button>
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
