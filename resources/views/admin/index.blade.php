@extends('layouts.admin')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-md-center flex-md-row flex-column justify-content-md-between">
                <h4 class="page-title">Selamat datang, Admin</h4>
                <div class="ml-md-auto text-md-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-md-6 col-lg-4">
                <div class="card card-hover">
                    <div class="box bg-secondary">
                        <h1 class="font-light text-white">{{ $banksampahNonactiveCount }}</h1>
                        <h6 class="text-white">Bank Sampah Belum Aktif</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-4">
                <div class="card card-hover">
                    <div class="box bg-secondary">
                        <h1 class="font-light text-white">{{ $usersCount }}</h1>
                        <h6 class="text-white">Pengguna</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-12 col-lg-4">
                <div class="card card-hover">
                    <div class="box bg-secondary">
                        <h1 class="font-light text-white">{{ $setoranPaymentsCount }}</h1>
                        <h6 class="text-white">Permintaan Konfirmasi Pembayaran</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <h4 class="card-title m-0">Bank Sampah belum aktif </h4>
                            <a href="{{ route('admin.banksampah') }}">Selengkapnya <i class="mdi mdi-arrow-right"></i></a>
                        </div>
                        <p class="mb-4 card-subtitle">Daftar bank sampah yang telah verifikasi email namun belum aktif.</p>
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>Nama Bank Sampah</th>
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($banksampahs->isEmpty())
                                <tr>
                                    <td colspan="4">
                                        <h4 class="font-bold text-center my-4">Seluruh bank sampah telah aktif.</h4>
                                    </td>
                                </tr>
                            @else
                                @foreach ($banksampahs as $banksampah)
                                    <tr>
                                        <td>{{ $banksampah->name }}</td>
                                        <td>{{ $banksampah->user->email }}</td>
                                        <td>{{ $banksampah->user->phone_number }}</td>
                                        <td>{{ $banksampah->status->name }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <h4 class="card-title m-0">Permintaan Konfirmasi Pembayaran</h4>
                            <a href="{{ route('admin.wallet') }}">Selengkapnya <i class="mdi mdi-arrow-right"></i></a>
                        </div>
                        <p class="mb-4 card-subtitle">Daftar pembayaran bank sampah yang belum dikonfirmasi.</p>
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>Bank Sampah</th>
                                <th>Nasabah</th>
                                <th>Metode</th>
                                <th>Via</th>
                                <th>Jumlah</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($setoranPayments->isEmpty())
                                <tr>
                                    <td colspan="5">
                                        <h4 class="font-bold text-center my-4">Seluruh pembayaran telah selesai.</h4>
                                    </td>
                                </tr>
                            @else
                                @foreach ($setoranPayments as $setoranPayment)
                                    <tr>
                                        <td>{{ $setoranPayment->setoran->banksampah->name }}</td>
                                        <td>{{ $setoranPayment->setoran->nasabah->name }}</td>
                                        <td>{{ $setoranPayment->payment_method }}</td>
                                        <td>{{ $setoranPayment->bankAccount->detail ?? "OVO " . $setoranPayment->ovo_number }}</td>
                                        <td>{{ $setoranPayment->setoran->price_total_nett_rp }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
