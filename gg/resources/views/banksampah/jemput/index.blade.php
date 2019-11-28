@extends('layouts.matrix')

@section('content')

    @include('partials.breadcrumb', ['title' => $title])

    {{--<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Segera Hadir...</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}

    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                {{--<div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="belumdikonfirmasi-tab" data-toggle="tab" href="#belumdikonfirmasi" role="tab">Belum Dikonfirmasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="belumdijemput-tab" data-toggle="tab" href="#belumdijemput" role="tab">Belum Dijemput</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="dijemput-tab" data-toggle="tab" href="#dijemput" role="tab">Dijemput</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="belumdikonfirmasi" role="tabpanel">
                                    @include('partials.table', [
                                        'thead' => [
                                            'ID Jemput',
                                            'Nama Nasabah',
                                            'Jenis Setoran',
                                            'Estimasi Berat',
                                            'Tanggal Permintaan Jemput',
                                            'Alamat',
                                            'Armada',
                                            'Status',
                                            'Aksi',
                                        ],
                                        'datas' => $jemputs->where('status_id', config('constants.statuses.BELUMKONFIRMASI'))->map(function ($item) {
                                            return [
                                                $item->id_pretty,
                                                $item->setoran->nasabah->name,
                                                $item->setoran->type,
                                                $item->weight_est,
                                                Carbon\Carbon::parse($item->date_pick_up)->isoFormat('dddd, D MMMM YYYY'),
                                                $item->setoran->nasabah->user->alamat->address,
                                                $item->fleet,
                                                $item->status->name,
                                                '
                                                <form id="jemputRejectForm'. $item->id .'" class="d-none" action="'.route('jemput.reject', ['jemput' => $item->id]) .'" method="POST">
                                                        '. method_field('PUT') . csrf_field() .'
                                                    </form>
                                                    <span data-id="'. $item->id .'" data-id-pretty="'. $item->id_pretty .'" data-toggle="modal" data-target="#confirmSetoranModal">
                                                        <button data-toggle="tooltip" data-placement="top" title="Konfirmasi" class="btn btn-success btn-sm py-0 px-1"><i class="mdi mdi-check mdi-18px"></i></button>
                                                    </span>
                                                    <span data-id="'. $item->id .'" data-toggle="modal" data-target="#rejectSetoranModal">
                                                        <button data-toggle="tooltip" data-placement="top" title="Tolak" type="button" class="btn btn-sm btn-danger py-0 px-1"><i class="mdi mdi-close mdi-18px"></i></button>
                                                    </span>
                                                    <span data-id="'. $item->id .'" data-toggle="modal" data-target="#editSetoranModal">
                                                        <button data-toggle="tooltip" data-placement="top" title="Ubah Tanggal Penjemputan" type="button" class="btn btn-sm btn-primary py-0 px-1"><i class="mdi mdi-pencil mdi-18px"></i></button>
                                                    </span>
                                                    <span data-id="'. $item->setoran->id .'" data-toggle="modal" data-target="#detailSetoranModal">
                                                        <button type="button" data-toggle="tooltip" data-placement="top" title="Detail" class="btn btn-sm btn-info py-0 px-1"><i class="mdi mdi-information-outline mdi-18px"></i></button>
                                                    </span>
                                                '
                                            ];
                                        }),
                                    ])
                                </div>
                                <div class="tab-pane fade" id="belumdijemput" role="tabpanel">
                                    @include('partials.table', [
                                        'thead' => [
                                            'ID Jemput',
                                            'Nama Nasabah',
                                            'Jenis Setoran',
                                            'Estimasi Berat',
                                            'Tanggal Permintaan Jemput',
                                            'Alamat',
                                            'Armada',
                                            'Penjemput',
                                            'Pegawai',
                                            'Status',
                                            'Aksi',
                                        ],
                                        'datas' => $jemputs->where('status_id', config('constants.statuses.BELUMJEMPUT'))->map(function ($item) {
                                            return [
                                                $item->id_pretty,
                                                $item->setoran->nasabah->name,
                                                $item->setoran->type,
                                                $item->weight_est,
                                                Carbon\Carbon::parse($item->date_pick_up)->isoFormat('dddd, D MMMM YYYY'),
                                                $item->setoran->nasabah->user->alamat->address,
                                                $item->fleet,
                                                [ 'class' => 'font-medium', 'value' => $item->pegawai->name ],
                                                [ 'class' => 'font-medium', 'value' => $item->setoran->pegawai ? $item->setoran->pegawai->name : 'Bank Sampah' ],
                                                $item->status->name,
                                                '
                                                    <form id="jemputPickupForm{{ $jemput->id }}" class="d-none" action="'.route('jemput.pickup', ['jemput' => $item->id]) .'" method="POST">
                                                        '. method_field('PUT') . csrf_field() .'
                                                    </form>
                                                    <button class="btn btn-primary btn-sm" onclick="event.preventDefault();
                                                        document.getElementById(\'jemputPickupForm'. $item->id .'\').submit()">Jemput</button>
                                                    <button type="button" data-id="{{ $jemput->setoran->id }}" data-toggle="modal" data-target="#detailSetoranModal" class="btn btn-sm btn-danger">Detail</button>
                                                '
                                            ];
                                        }),
                                    ])
                                </div>
                                <div class="tab-pane fade" id="dijemput" role="tabpanel">
                                    @include('partials.table', [
                                        'thead' => [
                                            'ID Jemput',
                                            'Nama Nasabah',
                                            'Jenis Setoran',
                                            'Estimasi Berat',
                                            'Tanggal Permintaan Jemput',
                                            'Alamat',
                                            'Armada',
                                            'Status',
                                            'Aksi',
                                        ],
                                        'datas' => $jemputs->where('status_id', config('constants.statuses.DIJEMPUT'))->map(function ($item) {
                                            return [
                                                $item->id_pretty,
                                                $item->setoran->nasabah->name,
                                                $item->setoran->type,
                                                $item->weight_est,
                                                Carbon\Carbon::parse($item->date_pick_up)->isoFormat('dddd, D MMMM YYYY'),
                                                $item->setoran->nasabah->user->alamat->address,
                                                $item->fleet,
                                                $item->status->name,
                                                '
                                                    <a href="'. route('setoran.edit', $item->setoran->id) .'" class="btn btn-sm btn-info">Kelola</a>
                                                    <button type="button" data-id="'. $item->setoran->id .'" data-toggle="modal" data-target="#detailSetoranModal" class="btn btn-sm btn-danger">Detail</button>
                                                '
                                            ];
                                        }),
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>--}}
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <h4 class="card-title m-0">Jadwal Nasabah</h4>
                                    <a href="#" data-toggle="modal" data-target="#addJadwalModal" class="btn btn-primary"><i class="mdi mdi-plus"></i> Tambah</a>
                                </div>
                                <div class="card-body py-0">
                                    <div class="nav btn-group row no-gutters" id="myTab" role="tablist">
                                        <a class="btn btn-outline-secondary col-6 active" id="konfirmasi-tab" data-toggle="tab" href="#konfirmasi" role="tab">Konfirmasi</a>
                                        <a class="btn btn-outline-secondary col-6" id="belum-tab" data-toggle="tab" href="#belum" role="tab">Menunggu</a>
                                    </div>
                                </div>
                                <div class="card-body tab-content">
                                    <div class="flex-column tab-pane show active" id="konfirmasi">
                                        @if ($jadwals->where('status_id', config('constants.statuses.AKTIF'))->isEmpty())
                                            <h5 class="text-muted text-center my-5">Belum ada nasabah.</h5>
                                        @endif
                                        @foreach ($jadwals->where('status_id', config('constants.statuses.AKTIF')) as $jadwal)
                                            <div class="bg-light rounded mb-2 d-flex px-3 py-2 justify-content-between">
                                                <p class="p-1 px-0 m-0 font-medium">{{ $jadwal->nasabah->name }}</p>
                                                <div>
                                                    <span data-toggle="tooltip" data-placement="top" title="Detail">
                                                        <a href="#" data-target="#jadwalModal" data-toggle="modal" data-jemputid="{{ $jadwal->id }}"><i class="mdi mdi-18px mdi-information"></i></a>
                                                    </span>
                                                    <form id="jadwalDeleteForm{{ $jadwal->id }}" class="d-none" action="{{ route('jadwal.destroy', ['jadwal' => $jadwal->id]) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="event.preventDefault();
                                                        document.getElementById('jadwalDeleteForm{{ $jadwal->id }}').submit()">
                                                        <i class="mdi mdi-18px mdi-close"></i></a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="flex-column tab-pane" id="belum">
                                        @if ($jadwals->where('status_id', config('constants.statuses.BELUMKONFIRMASI'))->isEmpty())
                                            <h5 class="text-muted text-center my-5">Belum ada nasabah.</h5>
                                        @endif
                                        @foreach ($jadwals->where('status_id', config('constants.statuses.BELUMKONFIRMASI')) as $jadwal)
                                            <div class="bg-light rounded mb-2 d-flex px-3 py-2 justify-content-between">
                                                <p class="p-1 px-0 m-0 font-medium">{{ $jadwal->nasabah->name }}</p>
                                                <div>
                                                    <span data-toggle="tooltip" data-placement="top" title="Detail">
                                                        <a href="#" data-target="#jadwalModal" data-toggle="modal" data-jemputid="{{ $jadwal->id }}"><i class="mdi mdi-18px mdi-information"></i></a>
                                                    </span>
                                                    <form id="jadwalAcceptForm{{ $jadwal->id }}" class="d-none" action="{{ route('jadwal.accept', ['jadwal' => $jadwal->id]) }}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                    </form>
                                                    <form id="jadwalRejectForm{{ $jadwal->id }}" class="d-none" action="{{ route('jadwal.reject', ['jadwal' => $jadwal->id]) }}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                    </form>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Terima" onclick="event.preventDefault();
                                                        document.getElementById('jadwalAcceptForm{{ $jadwal->id }}').submit()">
                                                        <i class="mdi mdi-18px mdi-check"></i></a>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Tolak" onclick="event.preventDefault();
                                                        document.getElementById('jadwalRejectForm{{ $jadwal->id }}').submit()">
                                                        <i class="mdi mdi-18px mdi-close"></i></a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-2">
                                        <div class="bg-info mb-2" style="height: 20px"></div>
                                        <span class="font-medium">Jadwal Aktif</span>
                                    </div>
                                    <div class="col-2">
                                        <div class="mb-2" style="background-color: #ccc; height: 20px"></div>
                                        <span class="font-medium">Jadwal tidak aktif</span>
                                    </div>
                                </div>
                                {{--<div class="mb-3">
                                    <i class="fa fa-circle text-danger"></i> <span class="font-medium">Belum dikonfirmasi</span>
                                    <i class="fa fa-circle ml-3 text-warning"></i> <span class="font-medium">Belum dijemput</span>
                                    <i class="fa fa-circle ml-3 text-success"></i> <span class="font-medium">Sudah dijemput</span>
                                    <i class="fa fa-circle ml-3 text-info"></i> <span class="font-medium">Jadwal aktif</span>
                                    <i class="fa fa-circle ml-3 text-muted"></i> <span class="font-medium">Jadwal tidak aktif</span>
                                </div>--}}
                                <div class="border">
                                    <div class="row no-gutters">
                                        <div class="col text-center font-medium border"><span>Senin</span></div>
                                        <div class="col text-center font-medium border"><span>Selasa</span></div>
                                        <div class="col text-center font-medium border"><span>Rabu</span></div>
                                        <div class="col text-center font-medium border"><span>Kamis</span></div>
                                        <div class="col text-center font-medium border"><span>Jumat</span></div>
                                        <div class="col text-center font-medium border"><span>Sabtu</span></div>
                                        <div class="col text-center font-medium border"><span>Minggu</span></div>
                                    </div>
                                    @for($i = 1; $i <= 5; $i++)
                                        <div class="row no-gutters">
                                            @for($k = 0; $k < 7; $k++)
                                                <div class="col border" style="height: 100px;">
                                                    <div class="p-1">
                                                        @foreach ($jadwals->filter(function ($item) use ($i, $k) {
                                                                return in_array($i, $item->weeksArray) && in_array($k === 6 ? 0 : $k + 1, $item->daysArray[array_search($i, $item->weeksArray)]);
                                                            }) as $j)
                                                            <p class="m-0 badge badge-{{ $j->status_id === config('constants.statuses.AKTIF') ? 'info' : 'secondary' }} w-100">{{ $j->nasabah->name }}</p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                    @endfor
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
    </div>

    <div id="mapModal" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Penjemputan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{--<div id="myMap" style="width: 100%;height: 400px;"></div>--}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="confirmSetoranModal" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi permintaan penjemputan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (!$drivers->isEmpty())
                        <form id="confirmJemputForm" action="" method="POST">
                            @csrf
                            @method('PUT')

                            <p class="font-medium mb-1">ID Jemput</p>
                            <p class="font-bold d-block"></p>

                            <div class="form-group">
                                <label for="pegawai_id">Driver</label>
                                <select name="pegawai_id" class="form-control select2" placeholder="Pilih driver...">
                                    <option value=""></option>
                                    @foreach ($drivers as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    @else
                        <h5 class="text-muted text-center my-4">Belum ada driver. <a href="{{ route('banksampah.pegawai-index') }}">Tambah driver.</a></h5>
                    @endif
                    <p class="text-muted m-0">
                        Silahkan pilih driver untuk melanjutkan permintaan penjemputan.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" disabled class="btn btn-danger">Konfirmasi permintaan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <div id="rejectSetoranModal" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tolak permintaan penjemputan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-muted m-0">
                        Apakah anda yakin ingin menolak permintaan penjemputan?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="rejectSetoranModalButton" class="btn btn-danger">Ya, Tolak permintaan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <div id="editSetoranModal" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Tanggal Penjemputan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h5 class="col-12 mb-3">Detail Nasabah</h5>
                        <div class="col-lg-4">
                            <p class="mb-2 font-medium">Nama Nasabah :</p>
                        </div>
                        <div class="col-lg-8" id="jadwalModalNama">

                        </div>

                        <div class="col-lg-4">
                            <p class="mb-2 font-medium">Nomor Telepon :</p>
                        </div>
                        <div class="col-lg-8" id="jadwalModalTelp">

                        </div>

                        <div class="col-lg-4">
                            <p class="mb-2 font-medium">Alamat :</p>
                        </div>
                        <div class="col-lg-8" id="jadwalModalAlamat">

                        </div>
                    </div>

                    <form id="editSetoranModalForm" action="" method="POST">
                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label for="date_pick_up" class="col-form-label col-lg-4">Tanggal Jemput</label>
                            <div class="col-lg-8">
                                <input type="text" name="date_pick_up" id="datepicker-disable-old" class="form-control">
                            </div>
                        </div>
                    </form>
                    <p class="text-muted m-0">
                        (*) Pastikan anda telah menghubungi nasabah bersangkutan.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                        document.getElementById('editSetoranModalForm').submit();">Simpan Perubahan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <div id="jadwalModal" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Jadwal Jemput Nasabah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="jadwalModalForm" class="row" action="" method="POST">
                        @method('PUT')
                        @csrf

                        <h5 class="col-12 mb-3">Detail Nasabah</h5>
                        <div class="col-lg-4">
                            <p class="mb-2 font-medium">Nama Nasabah :</p>
                        </div>
                        <div class="col-lg-8" id="jadwalModalNama">

                        </div>

                        <div class="col-lg-4">
                            <p class="mb-2 font-medium">Nomor Telepon :</p>
                        </div>
                        <div class="col-lg-8" id="jadwalModalTelp">

                        </div>

                        <div class="col-lg-4">
                            <p class="mb-2 font-medium">Alamat :</p>
                        </div>
                        <div class="col-lg-8" id="jadwalModalAlamat">

                        </div>

                        <h5 class="col-12 mt-4 d-flex justify-content-between align-items-center">Jadwal <span><a href="#" class="btn btn-info mr-2" id="ubahMinggu">Ubah</a><button class="btn btn-primary" id="tambahMinggu">+ Tambah</button></span></h5>

                        <div class="col-12 minggu row no-gutters">
                            <div class="col-md-6">
                                <div class="form-group my-1">
                                    <select name="weeks[]" class="select2 form-control jadwal-minggu">
                                        <option value="1">Minggu 1</option>
                                        <option value="2">Minggu 2</option>
                                        <option value="3">Minggu 3</option>
                                        <option value="4">Minggu 4</option>
                                        <option value="5">Minggu 5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-10">
                                <div class="form-group my-1 mb-3">
                                    <select name="days[0][]" class="select2 form-control jadwal-hari" multiple="multiple" placeholder="Pilih hari...">
                                        <option value="1">Senin</option>
                                        <option value="2">Selasa</option>
                                        <option value="3">Rabu</option>
                                        <option value="4">Kamis</option>
                                        <option value="5">Jum'at</option>
                                        <option value="6">Sabtu</option>
                                        <option value="0">Minggu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2 pt-1 pl-2">
                                <button class="btn btn-danger py-2 d-none"><i class="mdi mdi-close"></i></button>
                            </div>
                        </div>
                        <div class="col-12">
                            <p class="text-muted m-0">*) Pastikan anda telah mengubungi nasabah.</p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="jadwalModalButton" type="button" class="btn btn-primary" onclick="event.preventDefault();
                        document.getElementById('jadwalModalForm').submit();">Simpan Perubahan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
                            <div class="col-4 offset-8 row">
                                <span class="col-6 font-medium">Biaya Setoran:</span>
                                <span class="col-6 text-right font-16 font-bold" id="detailSetoranBiayaSetoran"></span>
                            </div>
                            <div class="col-4 offset-8 row">
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

    <div id="addJadwalModal" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jadwal Nasabah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (!$nasabahs->isEmpty())
                        <form id="addJadwalForm" class="row" action="{{ route('jadwal.store') }}" method="POST">
                            @csrf

                            <div class="form-group col-12">
                                <label for="nasabah_id">Nasabah</label>
                                <select name="nasabah_id" class="form-control select2" placeholder="Pilih nasabah...">
                                    <option value=""></option>
                                    @foreach ($nasabahs as $nasabah)
                                        <option value="{{ $nasabah->id }}">{{ $nasabah->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="status_id">Status</label>
                                <select name="status_id" class="form-control select2" placeholder="Pilih status...">
                                    @foreach ($statuses->only(['12', '5']) as $status)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <h5 class="col-12 mt-4 d-flex justify-content-between align-items-center">Jadwal <span><button class="btn btn-primary" id="tambahMingguAdd">+ Tambah</button></span></h5>

                            <div class="col-12 minggu row no-gutters">
                                <div class="col-md-6">
                                    <div class="form-group my-1">
                                        <select name="weeks[]" class="select2 form-control jadwal-minggu">
                                            <option value="1">Minggu 1</option>
                                            <option value="2">Minggu 2</option>
                                            <option value="3">Minggu 3</option>
                                            <option value="4">Minggu 4</option>
                                            <option value="5">Minggu 5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="form-group my-1 mb-3">
                                        <select name="days[0][]" class="select2 form-control jadwal-hari" multiple="multiple" placeholder="Pilih hari...">
                                            <option value="1">Senin</option>
                                            <option value="2">Selasa</option>
                                            <option value="3">Rabu</option>
                                            <option value="4">Kamis</option>
                                            <option value="5">Jum'at</option>
                                            <option value="6">Sabtu</option>
                                            <option value="0">Minggu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2 pt-1 pl-2">
                                    <button class="btn btn-danger py-2 d-none"><i class="mdi mdi-close"></i></button>
                                </div>
                            </div>
                        </form>
                    @else
                        <h5 class="text-muted text-center my-4">Belum ada nasabah. <a href="{{ route('banksampah.nasabah-index') }}">Tambah nasabah</a></h5>
                    @endif
                </div>
                <div class="modal-footer">
                    <button id="addJadwalFormButton" type="button" class="btn btn-primary" onclick="event.preventDefault();
                        document.getElementById('addJadwalForm').submit();">Tambah</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container -->
    <!-- ============================================================== -->
@endsection
@section('extra-script')
    <script>
        $.ajax({
            type: "POST",
            url: window.location.origin+"/api/jadwals",
            dataType: "json",
            data: {
                "banksampah_id": bsId
            },
            success: function(data) {
                jemputData = data;
            },
            error: function(response) {
                console.log(response);
            }
        });

        var mingguHariState = $("#jadwalModalForm").clone();
        var mingguHariStateAdd = $("#addJadwalForm").clone();

        $(function() {
            var id = 0;

            $("#rejectSetoranModal").on("show.bs.modal", function(event) {
                id = $(event.relatedTarget).data("id");
            });

            $("#rejectSetoranModalButton").on("click", function() {
                $("#jemputRejectForm"+id).submit();
            });
        });

        $(function() {
            var modal = $("#confirmSetoranModal");
            var confirm_btn = modal.find("button[disabled]");

            modal.on("show.bs.modal", function(e) {
                var button = $(e.relatedTarget);
                var id = button.data("id");
                var id_pretty = button.data("id-pretty");

                modal.find("form").attr({
                    action: "{{ route('jemput.confirm', '') }}".replace("t//c", "t/"+id+"/c"),
                })
                modal.find("p.font-bold").text(id_pretty);
            });

            modal.find("form .select2").on("select2:select", function() {
                confirm_btn.attr("disabled", false);
            });

            confirm_btn.on("click", function() {
                modal.find("form").submit();
            });
        });

        $(function() {
            $("#editSetoranModal").on("show.bs.modal", function(event) {
                var id = $(event.relatedTarget).data("id");
                var self = $(this);
                $.ajax({
                    type: "GET",
                    url: window.location.origin+"/banksampah/jemput/"+id,
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        self.find("#jadwalModalNama").text(data[0].jadwal.nasabah.name);
                        self.find("#jadwalModalTelp").text(data[0].jadwal.nasabah.user.phone_number);
                        self.find("#jadwalModalAlamat").text(data[0].jadwal.nasabah.user.alamat.address);
                        $("#editSetoranModalForm").find("input[type=text]").val(moment(data[0].date_pick_up).format("DD/MM/YYYY"));
                        $("#editSetoranModalForm").attr("action", window.location.origin+"/banksampah/jemput/"+id);
                    }
                })
            });
        });

        $("#jadwalModal").on("hidden.bs.modal", function(event) {
            $("#jadwalModal .modal-body").empty().append(mingguHariState.clone());
            $("#jadwalModalForm").find("select").select2();
        });

        $("#jadwalModal").on("show.bs.modal", function(event) {
            var jemputId = $(event.relatedTarget).data("jemputid");
            var jemputItem = jemputData.filter(function(item) {
                return item.id == jemputId;
            });
            var splittedWeeks = jemputItem[0].weeks.split(";");
            var splittedDays = jemputItem[0].days.split(";");
            var i = 0;

            if (splittedWeeks.length > 1) {
                var form = $("#jadwalModal .minggu:last");
                $("#jadwalModal").find("select").each(function(index){
                    $(this).select2("destroy");
                    $("*[data-select2-id]").removeAttr("data-select2-id");
                });

                $.each(splittedWeeks, function(index) {
                    if (index == 0) {
                        return
                    }
                    var cloned = form.clone(true).insertAfter("#jadwalModal .minggu:last");
                    cloned.find("select").each(function() {
                        if ($(this).hasClass("jadwal-hari")) {
                            i++;
                            $(this).attr("name", "days["+(i)+"][]");
                        }
                    });
                    // $("#jadwalModal").find(".select2").each(function(){
                    //     $(this).select2({
                    //         placeholder: $(this).attr("placeholder")
                    //     });
                    // });
                });
            }

            $(".jadwal-minggu").attr("disabled", true);
            $(".jadwal-hari").attr("disabled", true);
            $("#jadwalModalButton").attr("disabled", true);
            $("#tambahMinggu").attr("disabled", true);

            $(this).find("#jadwalModalNama").text(jemputItem[0].nasabah.name);
            $(this).find("#jadwalModalTelp").text(jemputItem[0].nasabah.user.phone_number);
            $(this).find("#jadwalModalAlamat").text(jemputItem[0].nasabah.user.alamat.address);
            $(this).find(".jadwal-minggu").each(function(index){
                $(this).select2({
                            placeholder: $(this).attr("placeholder"),
                            width: '100%'
                        }).val(splittedWeeks[index]).trigger("change");
            });
            $(this).find(".jadwal-hari").each(function(index){
                $(this).select2({
                            placeholder: $(this).attr("placeholder"),
                            width: '100%'
                        }).val(String(splittedDays[index]).split(",")).trigger("change");
            })

            $("#jadwalModalForm").attr("action", window.location.origin+"/banksampah/jadwal/"+jemputId);
        });

        $(function() {
            var i = 0;
            $(document).on("click", "#tambahMinggu", function(e) {
                e.preventDefault();
                var form = $("#jadwalModal .minggu:last");
                $("#jadwalModal").find("select").each(function(index){
                    $(this).select2("destroy");
                    $("*[data-select2-id]").removeAttr("data-select2-id");
                });

                var cloned = form.clone(true).insertAfter("#jadwalModal .minggu:last");
                cloned.find("select").each(function() {
                    if ($(this).hasClass("jadwal-hari")) {
                        i++;
                        $(this).attr("name", "days["+(i)+"][]");
                    }
                });
                $("#jadwalModal").find("select").each(function(){
                    $(this).select2({
                        placeholder: $(this).attr("placeholder")
                    });
                });
                var xbutton = $(".minggu:last").find("button");
                xbutton.removeClass("d-none");
                // form.find("select").each(function() {
                //     $(this).select2();
                //     $(this).val("").trigger("change");
                // });
            });

            $(document).on("click", ".minggu button", function(e) {
                e.preventDefault();
                $(this).parent().parent().remove();
            });

            $(document).on("click", "#ubahMinggu", function(e) {
                e.preventDefault();
                var xbutton = $(".minggu").find("button");
                if ($(".jadwal-minggu").is('[disabled=disabled]') || $(".jadwal-minggu").is('[disabled]')) {

                    $(".jadwal-minggu").each(function() {
                        $(this).attr("disabled", false);
                    });
                    $(".jadwal-hari").each(function() {
                        $(this).attr("disabled", false);
                    });
                    $("#jadwalModalButton").attr("disabled", false);
                    $("#tambahMinggu").attr("disabled", false);
                    $(this).removeClass('btn-info');
                    $(this).addClass('btn-light');
                    $(this).text("Batal");
                    if ($(".minggu").length > 1) {
                        xbutton.removeClass("d-none");
                        $(".minggu:eq(0)").find("button").addClass("d-none");
                    }
                    /*xbutton.removeClass("d-none");*/
                } else {

                    $(".jadwal-minggu").each(function() {
                        $(this).attr("disabled", "disabled");
                    });
                    $(".jadwal-hari").each(function() {
                        $(this).attr("disabled", "disabled");
                    });
                    $("#jadwalModalButton").attr("disabled", "disabled");
                    $("#tambahMinggu").attr("disabled", "disabled");
                    $(this).removeClass('btn-light');
                    $(this).addClass('btn-info');
                    $(this).text("Ubah");
                    xbutton.addClass("d-none");
                }
            });
        });

        $("#addJadwalModal").on("hidden.bs.modal", function(event) {
            if ($("#addJadwalModal .modal-body").find('form').length > 0) {
                $("#addJadwalModal .modal-body").empty().append(mingguHariStateAdd.clone());
            }
            $("#addJadwalForm").find(".select2").each(function(){
                $(this).select2({
                    placeholder: $(this).attr("placeholder"),
                    width: '100%',
                });
            });
        });

        $(function() {
            var i = 0;
            $(document).on("click", "#tambahMingguAdd", function(e) {
                e.preventDefault();
                var form = $("#addJadwalForm .minggu:last");
                $("#addJadwalForm").find("select").each(function(index){
                    $(this).select2("destroy");
                    $("*[data-select2-id]").removeAttr("data-select2-id");
                });

                var cloned = form.clone(true).insertAfter("#addJadwalForm .minggu:last");
                cloned.find("select").each(function() {
                    if ($(this).hasClass("jadwal-hari")) {
                        i++;
                        $(this).attr("name", "days["+(i)+"][]");
                    }
                });
                $("#addJadwalForm").find("select").each(function(){
                    $(this).select2({
                        placeholder: $(this).attr("placeholder")
                    });
                });
                var xbutton = $(".minggu:last").find("button");
                xbutton.removeClass("d-none");
                // form.find("select").each(function() {
                //     $(this).select2();
                //     $(this).val("").trigger("change");
                // });
            });
        });

        // $("#mapModal").on("hide.bs.modal", function(event) {
        //     for (var i = map.entities.getLength() - 1; i >= 0; i--) {
        //         var pushpin = map.entities.get(i);
        //         if (pushpin instanceof Microsoft.Maps.Pushpin) {
        //             map.entities.removeAt(i);
        //         }
        //     }
        // });
    </script>
@endsection
