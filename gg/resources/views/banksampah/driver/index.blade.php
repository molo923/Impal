@extends('layouts.driver')

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-lg-2 col-lg-8">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="belumdijemput-tab" data-toggle="pill" href="#belumdijemput" role="tab">Belum Dijemput</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="sedangdijemput-tab" data-toggle="pill" href="#sedangdijemput" role="tab">Sedang dijemput</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="dijemput-tab" data-toggle="pill" href="#dijemput" role="tab">Selesai</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="belumdijemput" role="tabpanel">
                        @if ($jemputs->where('status_id', config('constants.statuses.BELUMJEMPUT'))->isEmpty())
                            <h5 class="text-center py-5 font-weight-bold">Belum ada permintaan penjemputan.</h5>
                        @else
                            @foreach($jemputs->where('status_id', config('constants.statuses.BELUMJEMPUT')) as $jemput)
                                <div class="card mb-3">
                                    <div class="card-body d-flex">
                                        <div class="flex-grow-1">
                                            <p class="font-weight-bold m-0"><i class="mdi mdi-account"></i> {{ $jemput->setoran->nasabah->name }}</p>
                                            <p class="font-weight-bold m-0"><i class="mdi mdi-phone"></i> {{ $jemput->setoran->nasabah->user->phone_number }}</p>
                                            <p class="font-weight-bold m-0"><i class="mdi mdi-map-marker"></i> {{ $jemput->setoran->nasabah->user->alamat->full_address }}</p>
                                            <p class="font-weight-bold m-0"><i class="mdi mdi-car"></i> {{ $jemput->fleet }}</p>
                                            <p class="text-muted m-0 mt-2">Waktu Jemput: {{ Carbon\Carbon::parse($jemput->date_pick_up)->isoFormat('dddd, D MMMM YYYY') }}</p>
                                            <small>(*) Harap hubungi nasabah sebelum menjemput.</small>
                                        </div>
                                        <div class="d-flex align-items-center flex-column justify-content-center">
                                            <form id="pickupForm{{ $jemput->id }}" class="d-none" action="{{ route('jemput.pickup', $jemput->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                            <button onclick="event.preventDefault();
                                                                document.getElementById('pickupForm{{ $jemput->id }}').submit();" class="btn btn-primary d-block btn-block mb-2">Jemput</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="tab-pane fade" id="sedangdijemput" role="tabpanel">
                        @if ($jemputs->where('status_id', config('constants.statuses.DIJEMPUT'))->isEmpty())
                            <h5 class="text-center py-5 font-weight-bold">Belum ada permintaan penjemputan.</h5>
                        @else
                            @foreach($jemputs->where('status_id', config('constants.statuses.DIJEMPUT')) as $jemput)
                                <div class="card mb-3">
                                    <div class="card-body d-flex">
                                        <div class="flex-grow-1">
                                            <p class="font-weight-bold m-0"><i class="mdi mdi-account"></i> {{ $jemput->setoran->nasabah->name }}</p>
                                            <p class="font-weight-bold m-0"><i class="mdi mdi-phone"></i> {{ $jemput->setoran->nasabah->user->phone_number }}</p>
                                            <p class="font-weight-bold m-0"><i class="mdi mdi-map-marker"></i> {{ $jemput->setoran->nasabah->user->alamat->full_address }}</p>
                                            <p class="font-weight-bold"><i class="mdi mdi-car"></i> {{ $jemput->fleet }}</p>
                                            <small class="text-muted">Dijemput {{ $jemput->updated_at->diffForHumans() }}</small>
                                        </div>
                                        <div>
                                            <form id="doneForm{{ $jemput->id }}" class="d-none" action="{{ route('jemput.done', $jemput->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                            <button onclick="event.preventDefault();
                                                document.getElementById('doneForm{{ $jemput->id }}').submit();" class="btn btn-success d-block btn-block mb-2">Selesai</button>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="tab-pane fade" id="dijemput" role="tabpanel">
                        @if ($jemputs->where('status_id', config('constants.statuses.SELESAI'))->isEmpty())
                            <h5 class="text-center py-5 font-weight-bold">Belum ada permintaan penjemputan.</h5>
                        @else
                            @foreach($jemputs->where('status_id', config('constants.statuses.SELESAI')) as $jemput)
                                <div class="card mb-3">
                                    <div class="card-body d-flex">
                                        <div class="flex-grow-1">
                                            <p class="font-weight-bold m-0"><i class="mdi mdi-account"></i> {{ $jemput->setoran->nasabah->name }}</p>
                                            <p class="font-weight-bold m-0"><i class="mdi mdi-map-marker"></i> {{ $jemput->setoran->nasabah->user->alamat->full_address }}</p>
                                            <p class="font-weight-bold m-0"><i class="mdi mdi-car"></i> {{ $jemput->fleet }}</p>
                                        </div>
                                        <div>
                                            <small class="text-muted">Selesai {{ $jemput->updated_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
