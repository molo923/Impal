@extends('layouts.matrix')

@section('content')

    @include('partials.breadcrumb', ['title' => $title])

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('sampah-keluar.index') }}" class="btn btn-secondary"><i class="mdi mdi-arrow-left"></i> Kembali</a>
                        <h3 class="my-4">Sampah Keluar #{{ $sampahkeluar->id_pretty }}</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-6">
                                        <p class="text-muted font-bold mb-2">ID Sampah Keluar</p>
                                        <h5 class="mb-4">{{ $sampahkeluar->id_pretty }}</h5>

                                        <p class="text-muted font-bold mb-2">Jenis Sampah Keluar</p>
                                        <h5 class="mb-4">{{ ucfirst($sampahkeluar->type) }}</h5>

                                        <p class="text-muted font-bold mb-2">Tanggal Setor</p>
                                        <h5 class="mb-4">{{ $sampahkeluar->date_in_pretty }}</h5>

                                        <p class="text-muted font-bold mb-2">Tanggal Selesai</p>
                                        <h5 class="mb-4">{{ $sampahkeluar->date_done ? $sampahkeluar->date_done_pretty : '-' }}</h5>
                                    </div>

                                    <div class="col-6">
                                        <p class="text-muted font-bold mb-2">Total Berat</p>
                                        <h5 class="mb-4">@kg($sampahkeluar->total_weight)</h5>

                                        <p class="text-muted font-bold mb-2">Total Harga</p>
                                        <h5 class="mb-4">Rp @rp($sampahkeluar->price_total_nett)</h5>

                                        <p class="text-muted font-bold mb-2">Diinput Oleh</p>
                                        <h5 class="mb-4">{{ $sampahkeluar->banksampah ? 'Pemilik' : $sampahkeluar->pegawai->name }}</h5>

                                        <p class="text-muted font-bold mb-2">Status Sampah Keluar</p>
                                        <h5 class="mb-4">{{ $sampahkeluar->status->name }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">Detail Sampah Keluar</h4>
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
                                @foreach($sampahkeluar->sampahkeluarDetail as $s)
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
