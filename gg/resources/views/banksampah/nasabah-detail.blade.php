@extends('layouts.matrix')

@section('content')

    @include('partials.breadcrumb', ['title' => $title, 'custom' => 'Detail Nasabah', 'extra' => [
            [
                'url' => route('banksampah.nasabah-index'),
                'name' => 'Nasabah',
            ]
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
                <a href="{{ route('banksampah.nasabah-index') }}" class="btn btn-secondary mb-3"><i class="mdi mdi-arrow-left"></i> Kembali</a>

            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <img src="holder.js/60x60?theme=sky&size=18&text={{ $nasabah->user->name_abbr }}" alt="user" class="rounded-circle mr-2">
                            </div>
                            <div class="col-auto">
                                <h3>{{ $nasabah->name }} <span class="font-weight-normal text-muted">{{ $nasabah->user->username ? '(' . $nasabah->user->username . ')' : '' }}</span></h3>
                                <p class="text-secondary mb-4">{{ $nasabah->user->email }}</p>
                                {{--<a href="{{ route('banksampah.profile.edit') }}">Edit Profil</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4">Informasi Umum</h5>
                        <div class="row">
                            <div class="col-3 mb-2">
                                <strong>Nomor Telepon:</strong>
                            </div>
                            <div class="col-9">
                                {{ $nasabah->user->phone_number }}
                            </div>
                            <div class="col-3 mb-2">
                                <strong>Alamat:</strong>
                            </div>
                            <div class="col-9">
                                {{ $nasabah->user->alamat ? $nasabah->user->alamat->full_address : '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4">Riwayat Setoran {{ $nasabah->name }}</h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="all nowrap">ID Setoran</th>
                                    <th>Nama Nasabah</th>
                                    <th>Jenis Setoran</th>
                                    <th>Tgl Setor</th>
                                    <th>Tgl Selesai</th>
                                    <th>Total Berat (Kg)</th>
                                    <th>Total Harga (Rp)</th>
                                    <th>PIC</th>
                                    <th>Status</th>
                                    <th class="no-sort all">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($nasabah->setorans as $setoran)
                                    <tr>
                                        <td></td>
                                        <td><a href="{{ route('setoran.show', encrypt($setoran->id)) }}">{{ $setoran->id_pretty }}</a></td>
                                        <td>{{ $setoran->nasabah ? $setoran->nasabah->name : 'Bukan Nasabah' }}</td>
                                        <td>{{ $setoran->type }}</td>
                                        <td>{{ $setoran->store_in_pretty }}</td>
                                        <td>{{ $setoran->store_done_pretty ?: '-' }}</td>
                                        <td class="text-right">{{ $setoran->total_weight }}</td>
                                        <td>@rp($setoran->price_total_nett)</td>
                                        <td class="font-medium">{{ $setoran->pegawai ? $setoran->pegawai->name : 'Bank Sampah' }}</td>
                                        <td><span class="badge badge-{{ $setoran->status_id == config('constants.statuses.DIPROSES') ? 'secondary' : ($setoran->status_id == config('constants.statuses.REJECT') ? 'danger' : 'success') }}">{{ $setoran->status->name }}</span></td>
                                        <td>
                                            <button type="button" data-id="{{ $setoran->id }}" data-toggle="modal" data-target="#detailSetoranModal" class="btn btn-sm btn-danger">Detail</button>
                                            <button class="btn btn-info btn-sm dropdown-toggle" {{ $setoran->status_id === config('constants.statuses.SELESAI') ? 'disabled' : '' }} type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kelola</button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @if ($setoran->status_id === config('constants.statuses.DIPROSES'))
                                                    <a href="{{ route('setoran.edit', encrypt($setoran->id)) }}" class="dropdown-item"><i class="mdi mdi-pencil-box-outline mr-1 mdi-18px"></i> Edit</a>
                                                    <a href="#" data-action="{{ route('setoran.done', encrypt($setoran->id)) }}" class="setoran-done-btn dropdown-item"><i class="mdi mdi-check-circle-outline text-success mr-1 mdi-18px"></i> Selesai</a>
                                                    <a href="#" data-action="{{ route('setoran.reject', encrypt($setoran->id)) }}" class="setoran-reject-btn dropdown-item"><i class="mdi mdi-thumb-down-outline text-danger mr-1 mdi-18px"></i> Reject</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th>ID Setoran</th>
                                    <th>Nama Nasabah</th>
                                    <th>Jenis Setoran</th>
                                    <th>Tgl Setor</th>
                                    <th>Tgl Selesai</th>
                                    <th>Total Berat (Kg)</th>
                                    <th>Total Harga (Rp)</th>
                                    <th>PIC</th>
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

        <div id="detailSetoranModal" class="modal fade">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailSetoranTitle">Detail Setoran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="detailSetoranBody">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered border-left-0 border-right-0">
                                <thead id="detailSetoranTableHead">

                                </thead>
                                <tbody id="detailSetoranTableBody">

                                </tbody>
                            </table>
                            <div class="row no-gutters">
                                <div class="col-lg-4 offset-lg-8 col-12 row">
                                    <span class="col-6 font-medium">Biaya Setoran:</span>
                                    <span class="col-6 text-right font-16 font-bold" id="detailSetoranBiayaSetoran"></span>
                                </div>
                                <div class="col-lg-4 offset-lg-8 col-12 row">
                                    <span class="col-6 font-medium">Total:</span>
                                    <span class="col-6 text-right font-16 font-bold" id="detailSetoranTotalSetoran"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
