@extends('layouts.matrix')

@section('content')

    @include('partials.breadcrumb', ['title' => $title])

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('setoran.index') }}" class="btn btn-secondary"><i class="mdi mdi-arrow-left"></i> Kembali</a>
                        <h3 class="my-4">Setoran #{{ $setoran->id_pretty }}</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-2">Informasi Setoran</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="text-muted font-bold mb-2">ID Setoran</p>
                                        <h5 class="mb-4">{{ $setoran->id_pretty }}</h5>

                                        <p class="text-muted font-bold mb-2">Jenis Setoran</p>
                                        <h5 class="mb-4">{{ ucfirst($setoran->type) }}</h5>

                                        <p class="text-muted font-bold mb-2">Tanggal Setor</p>
                                        <h5 class="mb-4">{{ $setoran->store_in_pretty }}</h5>

                                        <p class="text-muted font-bold mb-2">Tanggal Selesai</p>
                                        <h5 class="mb-4">{{ $setoran->store_done_pretty ?? '-' }}</h5>

                                        <p class="text-muted font-bold mb-2">Status Setoran</p>
                                        <h5 class="mb-4">{{ $setoran->status->name }}</h5>
                                    </div>

                                    <div class="col-6">
                                        <p class="text-muted font-bold mb-2">Total Berat</p>
                                        <h5 class="mb-4">@kg($setoran->total_weight)</h5>

                                        <p class="text-muted font-bold mb-2">Biaya Setoran</p>
                                        <h5 class="mb-4">Rp @rp($setoran->store_cost)</h5>

                                        <p class="text-muted font-bold mb-2">Total Harga</p>
                                        <h5 class="mb-4">Rp @rp($setoran->price_total_nett)</h5>

                                        <p class="text-muted font-bold mb-2">Diinput Oleh</p>
                                        <h5 class="mb-4">{{ $setoran->banksampah ? 'Pemilik' : $setoran->pegawai->name }}</h5>

                                        <p class="text-muted font-bold mb-2">Keterangan</p>
                                        <h5 class="mb-4">{{ $setoran->description ?? '-' }}</h5>
                                    </div>
                                </div>
                            </div>
                            @if ($setoran->nasabah)
                                <div class="col-md-6">
                                    <h4 class="mb-2">Detail Nasabah</h4>
                                    <hr>
                                    <div>
                                        <p class="text-muted font-bold mb-2">Nama Nasabah</p>
                                        <h5 class="mb-4">{{ $setoran->nasabah->name }}</h5>

                                        <p class="text-muted font-bold mb-2">Nomor HP</p>
                                        <h5 class="mb-4">{{ $setoran->nasabah->user->phone_number }}</h5>

                                        <p class="text-muted font-bold mb-2">Alamat</p>
                                        <h5 class="mb-4">{{ $setoran->nasabah->user->alamat->full_address }}</h5>

                                        <p class="text-muted font-bold mb-2">Tanggal Bergabung</p>
                                        <h5 class="mb-4">{{ $setoran->nasabah->jadwal()->created_at->isoFormat('DD MMMM YYYY') }}</h5>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">Detail Setoran</h4>
                        <div class="table-responsive">
                            <table class="zero_config table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="all nowrap">Jenis Sampah</th>
                                    <th>Golongan</th>
                                    <th>Harga Setor (Rp)</th>
                                    <th>Berat (Kg)</th>
                                    <th>Sub Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($setoran->setoranDetail as $s)
                                    <tr>
                                        <td></td>
                                        <td>{{ $s->kategorisampah->code }}</td>
                                        <td>{{ $s->kategorisampah->name }}</td>
                                        <td>{{ $s->store_price ?? $s->custom_price }}</td>
                                        <td>{{ $s->weight }}</td>
                                        <td>Rp {{ $s->sub_total_rp }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Jenis Sampah</th>
                                    <th>Golongan</th>
                                    <th>Harga Setor (Rp)</th>
                                    <th>Berat (Kg)</th>
                                    <th>Sub Total</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop
