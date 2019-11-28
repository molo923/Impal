@extends('layouts.matrix')

@section('content')

    @include('partials.breadcrumb', ['title' => $title, 'extra' => [
            [
                'url' => route('kategori-sampah.stok'),
                'name' => 'Stok',
            ],
            [
                'url' => '',
                'name' => 'Mutasi',
            ],
        ]
    ])

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
                            <a href="{{ route('kategori-sampah.stok') }}" class="btn btn-secondary"><span class="mdi mdi-arrow-left"></span>Kembali</a>
                            <button href="#addMutasiModal" data-toggle="modal" class="btn btn-primary">+ Transfer</button>
                        </div>

                        <div>
                            <ul class="nav nav-tabs mb-3" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#transfer" role="tab">
                                    <span class="hidden-sm-up"></span><span class="hidden-xs-down">Transfer</span></a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#terima" role="tab">
                                    <span class="hidden-sm-up"></span> <span class="hidden-xs-down">Terima</span></a>
                                </li>
                            </ul>
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane active" id="transfer" role="tabpanel">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th class="nowrap">Tujuan Transfer</th>
                                            <th>Tanggal</th>
                                            <th class="nowrap">Berat (Kg)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($transfers as $transfer)
                                            <tr>
                                                <td></td>
                                                <td>{{ $transfer->kategorisampahTerima->kategorisampah->code . ' - ' . $transfer->kategorisampahTransfer->kategorisampah->name }}</td>
                                                <td>{{ $transfer->date_mutasi_pretty }}</td>
                                                <td class="text-right">{{ $transfer->weight_pretty }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Tujuan Transfer</th>
                                            <th>Tanggal</th>
                                            <th class="nowrap">Berat (Kg)</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="tab-pane" id="terima" role="tabpanel">
                                    <table id="zero_config2" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Terima Dari</th>
                                            <th>Tanggal</th>
                                            <th class="nowrap">Berat (Kg)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($terimas as $terima)
                                            <tr>
                                                <td></td>
                                                <td>{{ $terima->kategorisampahTransfer->kategorisampah->code . ' - ' . $terima->kategorisampahTransfer->kategorisampah->name }}</td>
                                                <td>{{ $terima->date_mutasi_pretty }}</td>
                                                <td class="text-right">{{ $terima->weight_pretty }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Terima Dari</th>
                                            <th>Tanggal</th>
                                            <th>Berat (Kg)</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->

        <div id="addMutasiModal" class="modal fade">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Transfer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="mutasiSampahForm" action="{{ route('kategori-sampah.mutasi.store', $kategorisampah_id) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="date_mutasi">Tanggal Transfer</label>
                                <div class="input-group">
                                    <input disabled type="text" value="{{ old('date_mutasi') ?? now()->isoFormat('L') }}" class="form-control" id="datepicker-autoclose" placeholder="dd/mm/yyyy" autocomplete="off">
                                    <input type="hidden" value="{{ now()->isoFormat('L') }}" class="form-control" name="date_mutasi">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>

                                    @error('date_mutasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kategorisampah_terima_id">Kategori Sampah</label>
                                <select name="kategorisampah_terima_id" class="custom-control @error('kategorisampah_terima_id') is-invalid @enderror custom-select">
                                    <option value="">Pilih kategori sampah</option>
                                    @foreach ($kategorisampahs->except([$kategorisampah_id]) as $kategorisampah)
                                        <option {{ old('kategorisampah_terima_id') == $kategorisampah->id ? 'selected' : '' }} value="{{ $kategorisampah->id }}">{{ $kategorisampah->code . ' - ' . $kategorisampah->name }}</option>
                                    @endforeach
                                </select>

                                @error('kategorisampah_terima_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="weight">Berat</label>
                                        <div class="input-group">
                                            <input type="text" value="{{ old('weight') }}" name="weight" class="form-control @error('weight') is-invalid @enderror" placeholder="0.0">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Kg</span>
                                            </div>
                                        </div>

                                        @error('weight')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('mutasiSampahForm').submit()">Tambah</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

@endsection
