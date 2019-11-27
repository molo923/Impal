@extends('layouts.matrix')

@section('content')

    @include('partials.breadcrumb', ['title' => 'Pengaturan Akun'])

    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-5">
                            <img src="holder.js/60x60?theme=sky&size=15&text={{ auth()->user()->name_abbr }}" alt="user" class="rounded-circle mr-3">
                            <div>
                                <h5 class="m-0">{{ auth()->user()->name }}</h5>
                                <a href="{{ route('banksampah.profile') }}">Profil saya</a>
                            </div>
                        </div>
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link {{ request()->url() === route('banksampah.account.edit') ? 'active' : 'text-secondary' }}" href="{{ route('banksampah.account.edit') }}">Akun</a>
                            {{--<a class="nav-link {{ request()->url() === route('banksampah.profile.edit') ? 'active' : 'text-secondary' }}" href="{{ route('banksampah.profile.edit') }}">Profil</a>--}}
                            <a class="nav-link {{ request()->url() === route('banksampah.bank-account') ? 'active' : 'text-secondary' }}" href="{{ route('banksampah.bank-account') }}">Akun Bank</a>
                            <a class="nav-link {{ request()->url() === route('banksampah.password.edit') ? 'active' : 'text-secondary' }}" href="{{ route('banksampah.password.edit') }}">Kata Sandi</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        @yield('as-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
