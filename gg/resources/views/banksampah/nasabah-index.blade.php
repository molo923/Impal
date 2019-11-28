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
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <button href="#addNasabahModal" data-toggle="modal" class="btn btn-primary ml-auto"><i class="mdi mdi-plus"></i> Tambah</button>
                        </div>

                        <div class="modal fade" id="addNasabahModal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah Nasabah</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addNasabahForm" class="form-horizontal" method="POST" action="{{ route('banksampah.nasabah-store') }}">
                                            @csrf

                                            <div class="form-group row">
                                                <label for="name" class="col-sm-3 text-md-right control-label col-form-label">Nama Lengkap</label>
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
                                                <label for="email" class="col-sm-3 text-md-right control-label col-form-label">Alamat Email</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email">
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="phone_number" class="col-sm-3 text-md-right control-label col-form-label">Nomor Telepon</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" name="phone_number">
                                                    @error('phone_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="gender" class="col-sm-3 text-md-right control-label col-form-label">Jenis Kelamin</label>
                                                <div class="col-sm-9">
                                                    <div class="d-flex align-items-center">
                                                        <div class="custom-control custom-radio mr-3">
                                                            <input type="radio" {{ old('gender') === 'L' ? 'checked' : '' }} class="custom-control-input @error('gender') is-invalid @enderror" value="L" id="laki" name="gender">
                                                            <label class="custom-control-label" for="laki">Laki-laki</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" {{ old('gender') === 'P' ? 'checked' : '' }} class="custom-control-input @error('gender') is-invalid @enderror" value="P" id="perempuan" name="gender">
                                                            <label class="custom-control-label" for="perempuan">Perempuan</label>
                                                        </div>
                                                    </div>
                                                    @error('gender')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="address" class="col-sm-3 text-md-right control-label col-form-label">Alamat</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" name="address">
                                                    @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="city" class="col-sm-3 text-md-right control-label col-form-label">Kota/Kabupaten</label>
                                                <div class="col-sm-9">
                                                    <select name="city" class="form-control @error('city') is-invalid @enderror select2" placeholder="Pilih kota...">
                                                        <option value=""></option>
                                                        @foreach ($kotas as $kota)
                                                            <option value="{{ ucwords(strtolower($kota->name)) }}" data-id="{{ $kota->id }}">{{ ucwords(strtolower($kota->name)) }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="districts" class="col-sm-3 text-md-right control-label col-form-label">Kecamatan</label>
                                                <div class="col-sm-9">
                                                    <select disabled="disabled" name="districts" class="form-control @error('districts') is-invalid @enderror select2" placeholder="Pilih kecamatan...">
                                                        <option value=""></option>
                                                    </select>
                                                    @error('districts')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="urban" class="col-sm-3 text-md-right control-label col-form-label">Kelurahan</label>
                                                <div class="col-sm-9">
                                                    <select disabled="disabled" name="urban" class="form-control @error('urban') is-invalid @enderror select2" placeholder="Pilih kelurahan...">
                                                        <option value=""></option>
                                                    </select>
                                                    @error('urban')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="postal_code" class="col-sm-3 text-md-right control-label col-form-label">Kode Pos</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control @error('postal_code') is-invalid @enderror" value="{{ old('postal_code') }}" name="postal_code">
                                                    @error('postal_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                                                                                               document.getElementById('addNasabahForm').submit()">Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="zero_config table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="all">Nama Lengkap</th>
                                    <th class="all">Nomor HP</th>
                                    <th data-priority="2">Alamat</th>
                                    <th class="none">ID Nasabah</th>
                                    <th class="none">Username</th>
                                    <th class="none">Email</th>
                                    <th class="none">Jenis Kelamin</th>
                                    <th class="none">Tgl Bergabung</th>
                                    <th data-priority="1">Status</th>
                                    <th class="no-sort">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($nasabahs as $nasabah)
                                        <tr>
                                            <td></td>
                                            <td>{{ $nasabah->name }}</td>
                                            <td>{{ $nasabah->user->phone_number ?? '-' }}</td>
                                            <td>{{ $nasabah->user->alamat->full_address }}</td>
                                            <td>{{ $nasabah->id }}</td>
                                            <td>{{ $nasabah->user->username }}</td>
                                            <td>{{ $nasabah->user->email }}</td>
                                            <td>{{ $nasabah->gender }}</td>
                                            <td>{{ $nasabah->jadwal()->created_at->isoFormat('DD MMMM YYYY') }}</td>
                                            <td><span class="badge badge-{{ $nasabah->jadwal()->status_id !== config('constants.statuses.AKTIF') ? 'secondary' : 'success' }}">{{ $nasabah->jadwal()->status->name }}</span></td>
                                            <td>
                                                <a href="{{ route('banksampah.nasabah-detail', $nasabah->id) }}" class="btn btn-sm btn-primary" >Detail</a>
                                                <form id="nonaktifNasabahForm{{ $nasabah->id }}" action="{{ route('banksampah.nasabah.toggle-status', $nasabah->id) }}" method="POST" class="d-none">
                                                    @method('put')
                                                    @csrf
                                                </form>
                                                <button type="button" onclick="event.preventDefault();
                                                    document.getElementById('nonaktifNasabahForm'+ {{$nasabah->id}} ).submit();" class="btn btn-sm btn-{{ check_status($nasabah->jadwal()->status_id, 'AKTIF') || check_status($nasabah->jadwal()->status_id, 'BELUMKONFIRMASI') ? 'secondary' : 'primary' }}">
                                                    {{ (check_status($nasabah->jadwal()->status_id, 'AKTIF') || check_status($nasabah->jadwal()->status_id, 'BELUMKONFIRMASI') ? 'Non-aktifkan' : 'Aktifkan') }}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Nama Lengkap</th>
                                    <th>Nomor HP</th>
                                    <th>Alamat</th>
                                    <th>ID Nasabah</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tgl Bergabung</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                </tfoot>
                            </table>
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
@section('extra-script')
    <script>
        $(function() {
            var token = function() {
                return $.ajax({
                    type: "GET",
                    url: "https://x.rajaapi.com/poe"
                });
            };

            $(".select2[name=city]").select2({
                placeholder: "Pilih kabupaten/kota...",
                dropdownParent: $("#addNasabahModal"),
                width: '100%'
            });

            $(".select2[name=city]").on("select2:select", function (e) {
                var city_id = $(".select2[name=city]").find(":selected").data("id");

                $(".select2[name=districts]").attr("disabled", false);
                $(".select2[name=districts]").select2({
                    placeholder: "Memuat kecamatan...",
                    dropdownParent: $("#addNasabahModal")
                });
                token().then(function (data) {
                    $.ajax({
                        type: "GET",
                        url: "https://x.rajaapi.com/MeP7c5ne" + data.token + "/m/wilayah/kecamatan?idkabupaten=" + city_id,
                        success: function (data) {
                            var the_data = ["",...data.data.map(function (item) {
                                return {
                                    id: item.name.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                                        return letter.toUpperCase();
                                    }),
                                    text: item.name.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                                        return letter.toUpperCase();
                                    }),
                                    districts_id: item.id,
                                }
                            })];

                            $(".select2[name=districts]").empty();
                            $(".select2[name=districts]").select2({
                                placeholder: "Pilih kecamatan...",
                                data: the_data,
                                dropdownParent: $("#addNasabahModal")
                            });
                            $(".select2[name=districts]").trigger({
                                type: "select2:select",
                                params: {
                                    data: the_data[0]
                                }
                            });
                        },
                    });
                });
            });

            $(".select2[name=districts]").on("select2:select", function(e) {

                $(".select2[name=urban]").attr("disabled", false);
                $(".select2[name=urban]").select2({
                    placeholder: "Memuat kelurahan...",
                    dropdownParent: $("#addNasabahModal")
                });
                token().then(function (data) {
                    $.ajax({
                        type: 'GET',
                        url: "https://x.rajaapi.com/MeP7c5ne" + data.token + "/m/wilayah/kelurahan?idkecamatan=" + e.params.data.districts_id,
                        success: function (data) {
                            $(".select2[name=urban]").empty();
                            $(".select2[name=urban]").select2({
                                dropdownParent: $("#addNasabahModal"),
                                data: data.data.map(function (item) {
                                    return {
                                        id: item.name.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                                            return letter.toUpperCase();
                                        }),
                                        text: item.name.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                                            return letter.toUpperCase();
                                        }),
                                    }
                                })
                            });
                        },
                    });
                });
            });
        });
    </script>
@endsection
