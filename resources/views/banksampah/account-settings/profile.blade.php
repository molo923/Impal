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
                        <div class="row">
                            <div class="col-lg-auto mb-lg-0 mb-3 text-center text-lg-left">
                                <img src="holder.js/100x100?theme=sky&size=25&text={{ auth()->user()->name_abbr }}" alt="user" class="rounded-circle mr-2">
                            </div>
                            <div class="col-lg-auto text-center text-lg-left">
                                <h3>{{ auth()->user()->name }} <span class="font-weight-normal text-muted">({{ auth()->user()->username }})</span></h3>
                                <p class="text-secondary mb-4">{{ auth()->user()->email }}</p>
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
                            <div class="col-md-3 mb-md-2">
                                <strong>Username:</strong>
                            </div>
                            <div class="col-md-9 mb-md-0 mb-2">
                                {{ auth()->user()->username }}
                            </div>
                            <div class="col-md-3 mb-md-2">
                                <strong>Alamat Email:</strong>
                            </div>
                            <div class="col-md-9 mb-md-0 mb-2">
                                {{ auth()->user()->email }}
                            </div>
                            <div class="col-md-3 mb-md-2">
                                <strong>Nomor Telepon:</strong>
                            </div>
                            <div class="col-md-9 mb-md-0 mb-2">
                                {{ auth()->user()->phone_number }}
                            </div>
                            <div class="col-md-3 mb-md-2">
                                <strong>Alamat:</strong>
                            </div>
                            <div class="col-md-9 mb-md-0 mb-2">
                                {{ auth()->user()->alamat ? auth()->user()->alamat->full_address : '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
