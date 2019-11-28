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
                            <div class="col-lg-7">
                                <form id="addForm" class="form-horizontal" method="POST" action="{{ route('setoran.store') }}">
                                    @csrf

                                    <a href="{{ route('setoran.index') }}" class="btn btn-secondary mr-2"><i class="mdi mdi-arrow-left"></i> Kembali</a>
                                    <h4 class="my-4">Detail Setoran</h4>
                                    <div class="form-group row">
                                        <label for="nasabah_id" class="col-md-3 text-lg-right control-label col-form-label">Nasabah</label>
                                        <div class="col-md-9">
                                            <select name="nasabah_id" placeholder="Pilih nasabah..." class="select2 form-control @error('nasabah_id') is-invalid @enderror custom-select" style="width: 100%; height:36px;">
                                                <option></option>
                                                <option value="bn">Bukan Nasabah</option>
                                                @foreach($nasabahs as $nasabah)
                                                    <option value="{{ $nasabah->id }}" {{ old('nasabah_id') == $nasabah->id ? 'selected' : '' }}>{{ $nasabah->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('nasabah_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="type" class="col-md-3 text-lg-right control-label col-form-label">Jenis Setoran</label>
                                        <div class="col-md-9">
                                            <select name="type" id="setoranType" placeholder="Pilih jenis setoran..." class="form-control @error('type') is-invalid @enderror custom-select" style="width: 100%; height:36px;">
                                                <option value="tabungan" {{ old('type') === 'tabungan' ? 'selected' : '' }}>Tabungan</option>
                                                <option value="beli" {{ old('type') === 'beli' ? 'selected' : '' }}>Beli</option>
                                                <option value="hibah" {{ old('type') === 'hibah' ? 'selected' : '' }}>Hibah</option>
                                                <option value="retur" {{ old('type') === 'retur' ? 'selected' : '' }}>Retur</option>
                                            </select>
                                            @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="store_in" class="col-md-3 text-lg-right control-label col-form-label">Tanggal Setor</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input value="{{ old('store_in') ?? now()->isoFormat('L') }}" type="text" class="form-control @error('store_in') is-invalid @enderror" name="store_in" id="datepicker-autoclose" placeholder="dd/mm/yyyy" autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>

                                                @error('store_in')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="store_cost" class="col-md-3 text-lg-right control-label col-form-label">Biaya Setoran (Opsional)</label>
                                        <div class="col-md-9">
                                            <input value="{{ old('store_cost') }}" type="number" class="form-control @error('store_cost') is-invalid @enderror py-2" name="store_cost">

                                            @error('store_cost')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-md-3 text-lg-right control-label col-form-label">Keterangan (Opsional)</label>
                                        <div class="col-md-9">
                                            <input value="{{ old('description') }}" type="text" class="form-control @error('description') is-invalid @enderror py-2" name="description">

                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status_id" class="col-md-3 text-lg-right control-label col-form-label">Status Setoran</label>
                                        <div class="col-md-9 d-flex align-items-center">
                                            @foreach($statuses->only([8, 9]) as $status)
                                                <div class="custom-control custom-radio mr-3">
                                                    <input type="radio" {{ old('status_id') == $status->id || $loop->first ? 'checked' : '' }} class="custom-control-input" id="{{ $status->name . $status->id }}" name="status_id" value="{{ $status->id }}">
                                                    <label class="custom-control-label" for="{{ $status->name . $status->id }}">{{ $status->name }}</label>
                                                </div>
                                            @endforeach
                                            {{--<select name="status_id" placeholder="Pilih status setoran..." class="select2 form-control @error('status_id') is-invalid @enderror custom-select" style="width: 100%; height:36px;">

                                                @foreach($statuses->only([8,9]) as $status)
                                                    <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                                                @endforeach
                                            </select>--}}
                                            @error('status_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-5 mb-4">
                                        <h4 class="m-0">Jenis Sampah</h4>
                                        <button id="addAnotherInput" {{ count($kategorisampahs) > 0 ? '' : 'disabled'  }} onclick="event.preventDefault();" class="btn btn-primary"><i class="mdi mdi-plus"></i> Tambah</button>
                                    </div>

                                    @if(count($kategorisampahs) > 0)
                                        @if($errors->any())
                                            @foreach (old('kategorisampahs') as $key => $ks)
                                                <div class="form-group row kategori-sampah">
                                                    <div class="col-md-9 kategori-sampah create">
                                                        <label for="kategorisampahs" class="control-label">Kategori Sampah</label>
                                                        <select name="kategorisampahs[]" placeholder="Pilih jenis sampah..." class="form-control @error('kategorisampahs.'.$key) is-invalid @enderror custom-select" style="width: 100%; height:36px;">
                                                            <option value="">Pilih jenis sampah...</option>
                                                            @foreach($kategorisampahs as $kategorisampah)
                                                                <option value="{{ $kategorisampah->id }}" {{ $ks == $kategorisampah->id ? 'selected' : '' }}>{{ $kategorisampah->code . " - " . $kategorisampah->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('kategorisampahs.'.$key)
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="weight" class="control-label">Berat</label>
                                                        <div class="input-group">
                                                            <input type="number" value="{{ old('weight')[$key] }}" class="form-control @error('weight.'.$key) is-invalid @enderror" placeholder="0.0" name="weight[]">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Kg</span>
                                                            </div>
                                                            @error('weight.'.$key)
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 d-none harga">
                                                        <label for="custom_price" class="control-label">Harga</label>
                                                        <input type="number" value="{{ old('custom_price')[$key] }}" class="form-control @error('custom_price.'.$key) is-invalid @enderror" placeholder="0.0" name="custom_price[]">

                                                        @error('custom_price.'.$key)
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12 py-2 d-flex">
                                                        <button onclick="event.preventDefault();
                                                                        var mmxA = event.target.parentNode.parentNode;
                                                                        mmxA.parentNode.removeChild(mmxA);ktSampah++;" class="@if($loop->first) d-none @endif btn btn-danger btn-sm ml-auto">Hapus</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <script>ktSampah--;</script>
                                            <div class="form-group row kategori-sampah">
                                            <div class="col-md-9 kategori-sampah create">
                                                <label for="kategorisampahs" class="control-label">Kategori Sampah</label>
                                                <select name="kategorisampahs[]" placeholder="Pilih jenis sampah..." class="form-control @error('kategorisampahs.*') is-invalid @enderror custom-select" style="width: 100%; height:36px;">
                                                    <option value="">Pilih jenis sampah...</option>
                                                    @foreach($kategorisampahs as $kategorisampah)
                                                        <option value="{{ $kategorisampah->id }}">{{ $kategorisampah->code . " - " . $kategorisampah->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('kategorisampahs.*')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label for="weight" class="control-label">Berat</label>
                                                <div class="input-group">
                                                    <input type="number" value="{{ old('weight.*') }}" class="form-control @error('weight.*') is-invalid @enderror" placeholder="0.0" name="weight[]">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Kg</span>
                                                    </div>
                                                </div>
                                                @error('weight.*')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-3 d-none harga">
                                                <label for="custom_price" class="control-label">Harga</label>
                                                <input type="number" value="{{ old('custom_price.*') }}" class="form-control @error('custom_price.*') is-invalid @enderror" placeholder="0.0" name="custom_price[]">

                                                @error('custom_price.*')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 py-2 d-flex">
                                                <button onclick="event.preventDefault();
                                                        var mmxA = event.target.parentNode.parentNode;
                                                        mmxA.parentNode.removeChild(mmxA);
                                                        ktSampah++;" class="d-none btn btn-danger btn-sm ml-auto">Hapus</button>
                                            </div>
                                        </div>
                                        @endif
                                    @else
                                        <h5 class="font-bold text-muted text-center my-4">Belum ada kategori sampah. <a href="{{ route('kategori-sampah.index') }}">Tambah</a></h5>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body d-flex justify-content-end">
                            <a href="{{ route('setoran.index') }}" class="btn btn-secondary mr-2">Batal</a>
                            <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                                                                                   document.getElementById('addForm').submit()">Tambah Setoran</button>
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
