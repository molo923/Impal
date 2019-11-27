<div class="modal fade" id="addKategoriSampahModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori Sampah</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="addKategoriSampahForm" class="form-horizontal" method="POST" action="{{ route('kategori-sampah.store') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="code" class="col-sm-3 text-right control-label col-form-label">Kode Sampah</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" name="code">
                            @error('code')
                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 text-right control-label col-form-label">Golongan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-3 text-right control-label col-form-label">Harga Sampah</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" name="price">
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 text-right control-label col-form-label">Deskripsi (Opsional)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="description">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenissampah_id" class="col-sm-3 text-right control-label col-form-label">Jenis Sampah</label>
                        <div class="col-md-9">
                            <select name="jenissampah_id" placeholder="Pilih jenis sampah..." class="select2 form-control @error('jenissampah_id') is-invalid @enderror custom-select" style="width: 100%; height:36px;">
                                <option></option>
                                @foreach($jenissampahs as $jenissampah)
                                    <option value="{{ $jenissampah->id }}">{{ $jenissampah->type }}</option>
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
                        <label for="status_id" class="col-sm-3 text-right control-label col-form-label">Status Sampah</label>
                        <div class="col-md-9">
                            <select name="status_id" placeholder="Pilih status..." class="select2 form-control @error('status_id') is-invalid @enderror custom-select" style="width: 100%; height:36px;">
                                <option></option>
                                @foreach($statuses->only([5,6]) as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                                                                                               document.getElementById('addKategoriSampahForm').submit()">Tambah</button>
            </div>
        </div>
    </div>
</div>
