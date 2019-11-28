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
                        @if ($setoran->status_id === config('constants.statuses.SELESAI'))
                            <div class="alert alert-warning" role="alert">
                                Setoran telah selesai. anda tidak dapat mengubah setoran yang telah selesai.
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-8">
                                <form id="editSetoranForm" class="form-horizontal row" method="POST" action="{{ route('setoran.update', $setoran->id) }}">
                                    @method('put')
                                    @csrf

                                    <div class="col-lg-9">
                                        <a href="{{ route('setoran.index') }}" class="btn btn-secondary mr-2"><i class="mdi mdi-arrow-left"></i> Kembali</a>
                                        <h4 class="my-4">Detail Setoran</h4>
                                        <div class="form-group row">
                                            <label for="nasabah_id" class="col-md-3 text-lg-right control-label col-form-label">Nasabah</label>
                                            <div class="col-md-9">
                                                <select {{ $setoran->status_id === config('constants.statuses.SELESAI') ? 'disabled' : '' }} name="nasabah_id" placeholder="Pilih nasabah..." class="select2 form-control @error('nasabah_id') is-invalid @enderror custom-select" style="width: 100%; height:36px;">
                                                    <option></option>
                                                    <option value="bn" {{ ($setoran->nasabah_id ?? 'selected') }}>Bukan Nasabah</option>
                                                    @foreach($nasabahs as $nasabah)
                                                        <option value="{{ $nasabah->id }}" {{ $setoran->nasabah_id === $nasabah->id ? 'selected' : '' }}>{{ $nasabah->name }}</option>
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
                                                <select {{ $setoran->status_id === config('constants.statuses.SELESAI') ? 'disabled' : '' }} name="type" id="setoranType" placeholder="Pilih jenis setoran..." class="form-control @error('type') is-invalid @enderror custom-select" style="width: 100%; height:36px;">
                                                    <option value="tabungan" {{ old('type') ? (old('type') === 'tabungan' ? 'selected' : '') : ($setoran->type === 'tabungan' ? 'selected' : '') }}>Tabungan</option>
                                                    <option value="beli" {{ old('type') ? (old('type') === 'beli' ? 'selected' : '') : ($setoran->type === 'beli' ? 'selected' : '') }}>Beli</option>
                                                    <option value="hibah" {{ old('type') ? (old('type') === 'hibah' ? 'selected' : '') : ($setoran->type === 'hibah' ? 'selected' : '') }}>Hibah</option>
                                                    <option value="retur" {{ old('type') ? (old('type') === 'retur' ? 'selected' : '') : ($setoran->type === 'retur' ? 'selected' : '') }}>Retur</option>
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
                                                    <input {{ $setoran->status_id === config('constants.statuses.SELESAI') ? 'disabled' : '' }} type="text" value="{{ $setoran->store_in_date }}" class="form-control @error('store_in') is-invalid @enderror" name="store_in" id="datepicker-autoclose" placeholder="dd/mm/yyyy" autocomplete="off">
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
                                                <input {{ $setoran->status_id === config('constants.statuses.SELESAI') ? 'disabled' : '' }} type="number" value="{{ $setoran->store_cost }}" class="form-control @error('store_cost') is-invalid @enderror py-2" name="store_cost">

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
                                                <input {{ $setoran->status_id === config('constants.statuses.SELESAI') ? 'disabled' : '' }} type="text" value="{{ $setoran->description }}" class="form-control @error('description') is-invalid @enderror py-2" name="description">

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
                                                @foreach($statuses->only([9, 11]) as $status)
                                                    <div class="custom-control custom-radio mr-3">
                                                        <input type="radio" {{ old('status_id') == $status->id }} class="custom-control-input" id="{{ $status->name . $status->id }}" name="status_id" value="{{ $status->id }}">
                                                        <label class="custom-control-label" for="{{ $status->name . $status->id }}">{{ $status->name }}</label>
                                                    </div>
                                                @endforeach

                                                @error('status_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center mt-5 mb-4">
                                            <h4 class="m-0">Jenis Sampah</h4>
                                            <div>
                                                <button id="addAnotherInputEdit" onclick="event.preventDefault();" {{ $setoran->status_id === config('constants.statuses.SELESAI') ? 'disabled' : '' }} class="btn btn-primary"><i class="mdi mdi-plus"></i> Tambah</button>
                                            </div>
                                        </div>
                                        @if(count($setoran->setoranDetail) > 1)
                                            @foreach ($setoran->setoranDetail as $index => $setoranDetail)
                                                <script>ktSampah--;</script>
                                                <div class="form-group row kategori-sampah">
                                                    <div class="col-md-6 kategori-sampah edit">
                                                        <label for="kategorisampahs" class="control-label">Kategori Sampah</label>
                                                        <select {{ $setoran->status_id === config('constants.statuses.SELESAI') ? 'disabled' : '' }} name="kategorisampahs[]" placeholder="Pilih jenis sampah..." class="form-control @error('kategorisampahs.'.$index) is-invalid @enderror custom-select" style="width: 100%; height:36px;">
                                                            <option value="">Pilih jenis sampah...</option>
                                                            @foreach($kategorisampahs as $kategorisampah)
                                                                <option value="{{ $kategorisampah->id }}" {{ ($setoranDetail->kategorisampah->id === $kategorisampah->id
                                                                                                                ? 'selected'
                                                                                                                : '') }}>{{ $kategorisampah->code . " - " . $kategorisampah->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @if($setoran->status_id === config('constants.statuses.SELESAI'))
                                                            <input type="hidden" name="kategorisampahs[]" value="{{ $setoranDetail->kategorisampah->id }}">
                                                        @endif

                                                        @error('kategorisampahs.'.$index)
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="weight" class="control-label">Berat</label>
                                                        <div class="input-group">
                                                            <input {{ $setoran->status_id === config('constants.statuses.SELESAI') ? 'disabled' : '' }} value="{{ old('weight')[$index] ?? $setoranDetail->weight }}" type="number" class="form-control @error('weight.'.$index) is-invalid @enderror" placeholder="0.0" name="weight[]">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Kg</span>
                                                            </div>

                                                            @if($setoran->status_id === config('constants.statuses.SELESAI'))
                                                                <input type="hidden" name="weight[]" value="{{ $setoranDetail->kategorisampah->weight }}">
                                                            @endif

                                                            @error('weight.'.$index)
                                                            <span class="invalid-feedback d-block" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 d-none harga">
                                                        <label for="custom_price" class="control-label">Harga</label>
                                                        <div class="input-group">
                                                            <input {{ $setoran->status_id === config('constants.statuses.SELESAI') ? 'disabled' : '' }} value="{{ old('custom_price')[$index] ?? $setoranDetail->custom_price }}" type="number" class="form-control @error('custom_price.'.$index) is-invalid @enderror" placeholder="0.0" name="custom_price[]">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Kg</span>
                                                            </div>

                                                            @if($setoran->status_id === config('constants.statuses.SELESAI'))
                                                                <input type="hidden" name="custom_price[]" value="{{ $setoranDetail->kategorisampah->custom_price }}">
                                                            @endif

                                                            @error('custom_price.'.$index)
                                                            <span class="invalid-feedback d-block" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="setoran_detail_status" class="control-label">Status</label>
                                                        <select {{ $setoran->status_id === config('constants.statuses.SELESAI') ? 'disabled' : '' }} name="setoran_detail_status[]" class="form-control @error('setoran_detail_status.*') is-invalid @enderror custom-select" style="width: 100%; height:36px;">
                                                            @foreach($statuses->only([9,10,11]) as $status)
                                                                <option value="{{ $status->id }}" {{ ($setoranDetail->status->id === $status->id
                                                                                                                ? 'selected'
                                                                                                                : '') }}>{{ $status->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @if($setoran->status_id === config('constants.statuses.SELESAI'))
                                                            <input type="hidden" name="setoran_detail_status[]" value="{{ $setoranDetail->status->id }}">
                                                        @endif

                                                        @error('setoran_detail_status.*')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-12 py-2 d-flex">
                                                        <button onclick="event.preventDefault();
                                                                    var mmxA = event.target.parentNode.parentNode;
                                                                    mmxA.parentNode.removeChild(mmxA);ktSampah++" class="@if($loop->first) d-none @endif {{ $setoran->status_id === config('constants.statuses.SELESAI') ? 'd-none' : '' }} btn btn-danger btn-sm ml-auto">Hapus</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @elseif($errors->any() && old('kategorisampahs') || count($setoran->setoranDetail) === 1)
                                            @foreach(old('kategorisampahs') ?? $setoran->setoranDetail as $index => $ks)
                                                <script>ktSampah--;</script>
                                            <div class="form-group row kategori-sampah">
                                                <div class="col-md-6 kategori-sampah edit">
                                                    <label for="kategorisampahs" class="control-label">Kategori Sampah</label>
                                                    <select {{ $setoran->status_id === config('constants.statuses.SELESAI') ? 'disabled' : '' }} name="kategorisampahs[]" placeholder="Pilih jenis sampah..." class="form-control @error('kategorisampahs.'.$index) is-invalid @enderror custom-select" style="width: 100%; height:36px;">
                                                        <option value="">Pilih jenis sampah...</option>

                                                        @foreach($kategorisampahs as $kategorisampah)
                                                            <option value="{{ $kategorisampah->id }}" {{ ($setoran->setoranDetail[$index]->kategorisampah->id
                                                                                                                        ?? old('kategorisampahs.'.$index)) == $kategorisampah->id
                                                                                                                        ? 'selected' : '' }}>{{ $kategorisampah->code . " - " . $kategorisampah->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('kategorisampahs.'.$index)
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="weight" class="control-label">Berat</label>
                                                    <div class="input-group">
                                                        <input {{ $setoran->status_id === config('constants.statuses.SELESAI') ? 'disabled' : '' }} value="{{ $setoran->setoranDetail[$index]->weight ?? old('weight.'.$index) }}" type="number" class="form-control @error('weight.'.$index) is-invalid @enderror" placeholder="0.0" name="weight[]">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Kg</span>
                                                        </div>
                                                    </div>
                                                    @error('weight.'.$index)
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3 d-none harga">
                                                    <label for="custom_price" class="control-label">Harga</label>
                                                    <div class="input-group">
                                                        <input {{ $setoran->status_id === config('constants.statuses.SELESAI') ? 'disabled' : '' }} value="{{ $setoran->setoranDetail[$index]->custom_price ?? old('custom_price.'.$index) }}" type="number" class="form-control @error('custom_price.'.$index) is-invalid @enderror" placeholder="0.0" name="custom_price[]">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Kg</span>
                                                        </div>
                                                    </div>
                                                    @error('custom_price.'.$index)
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="setoran_detail_status" class="control-label">Status</label>
                                                    <select {{ $setoran->status_id === config('constants.statuses.SELESAI') ? 'disabled' : '' }} name="setoran_detail_status[]" class="form-control @error('setoran_detail_status.'.$index) is-invalid @enderror custom-select" style="width: 100%; height:36px;">
                                                        @foreach($statuses->only([9,10,11]) as $status)
                                                            <option value="{{ $status->id }}" {{ ($setoran->setoranDetail[$index]->status->id ?? old('setoran_detail_status.'.$index)) == $status->id
                                                                                                                ? 'selected'
                                                                                                                : '' }}>{{ $status->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('setoran_detail_status.'.$index)
                                                    <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 py-2 d-flex">
                                                    <button onclick="event.preventDefault()
                                                                    ;var mmxA = event.target.parentNode.parentNode;
                                                                    mmxA.parentNode.removeChild(mmxA);ktSampah++" class="@if($loop->first) d-none @endif btn btn-danger btn-sm ml-auto">Hapus</button>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    {{--<div class="col-12">
                                        <button data-toggle="tooltip" data-placement="top" title="Selesaikan Semua" class="text-light btn btn-sm btn-dark rounded py-0 px-1">
                                            <span class="mdi mdi-check mdi-18px"></span>
                                        </button>
                                        <button data-toggle="tooltip" data-placement="top" title="Reject Semua" class="text-light btn btn-sm btn-dark rounded py-0 px-1">
                                            <span class="mdi mdi-close mdi-18px"></span>
                                        </button>
                                    </div>--}}
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body d-flex justify-content-end">
                            <a href="{{ route('setoran.index') }}" class="btn btn-secondary mr-2">Batal</a>
                            <button {{ $setoran->status_id === config('constants.statuses.SELESAI') ? 'disabled' : '' }} type="button" class="btn btn-primary" onclick="event.preventDefault();
                                                                                   document.getElementById('editSetoranForm').submit()">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="confirmDeleteModal" class="modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus kategori ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="confirmDeleteModalConfirm" class="btn btn-danger">Hapus</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
