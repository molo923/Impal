@extends('layouts.matrix')

@section('content')

    @include('partials.breadcrumb', ['title' => $title])

    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
{{--    <div class="container-fluid">--}}
{{--        <!-- ============================================================== -->--}}
{{--        <!-- Start Page Content -->--}}
{{--        <!-- ============================================================== -->--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="d-flex justify-content-between align-items-center mb-3">--}}
{{--                            <button href="#addDriverModal" data-toggle="modal" class="btn btn-primary ml-auto">Tambah</button>--}}
{{--                        </div>--}}

{{--                        <div class="modal fade" id="addDriverModal">--}}
{{--                            <div class="modal-dialog modal-lg">--}}
{{--                                <div class="modal-content">--}}
{{--                                    <div class="modal-header">--}}
{{--                                        <h4 class="modal-title">Tambah Driver</h4>--}}
{{--                                        <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
{{--                                    </div>--}}
{{--                                    <div class="modal-body">--}}
{{--                                        <form id="addDriverForm" class="form-horizontal" method="POST" action="{{ route('driver.store') }}">--}}
{{--                                            @csrf--}}

{{--                                            <div class="form-group row">--}}
{{--                                                <label for="name" class="col-sm-3 text-right control-label col-form-label">Nama lengkap</label>--}}
{{--                                                <div class="col-sm-9">--}}
{{--                                                    <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name">--}}
{{--                                                    @error('name')--}}
{{--                                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                        <strong>{{ $message }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group row">--}}
{{--                                                <label for="username" class="col-sm-3 text-right control-label col-form-label">Nama user</label>--}}
{{--                                                <div class="col-sm-9">--}}
{{--                                                    <input type="text" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" name="username">--}}
{{--                                                    @error('username')--}}
{{--                                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                        <strong>{{ $message }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group row">--}}
{{--                                                <label for="email" class="col-sm-3 text-right control-label col-form-label">Alamat email</label>--}}
{{--                                                <div class="col-sm-9">--}}
{{--                                                    <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email">--}}
{{--                                                    @error('email')--}}
{{--                                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                        <strong>{{ $message }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group row">--}}
{{--                                                <label for="password" class="col-sm-3 text-right control-label col-form-label">Kata sandi</label>--}}
{{--                                                <div class="col-sm-9">--}}
{{--                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">--}}
{{--                                                    @error('password')--}}
{{--                                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                        <strong>{{ $message }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group row">--}}
{{--                                                <label for="phone_number" class="col-sm-3 text-right control-label col-form-label">Nomor telepon</label>--}}
{{--                                                <div class="col-sm-9">--}}
{{--                                                    <input type="text" value="{{ old('phone_number') }}" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number">--}}
{{--                                                    @error('phone_number')--}}
{{--                                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                        <strong>{{ $message }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                    <div class="modal-footer">--}}
{{--                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>--}}
{{--                                        <button type="button" class="btn btn-primary" onclick="event.preventDefault();--}}
{{--                                                                                               document.getElementById('addDriverForm').submit()">Tambah</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="table-responsive">--}}
{{--                            <table id="zero_config" class="table table-striped table-bordered">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>ID Driver</th>--}}
{{--                                    <th>Nama Lengkap</th>--}}
{{--                                    <th>Email</th>--}}
{{--                                    <th>Telepon</th>--}}
{{--                                    <th>Nama User</th>--}}
{{--                                    <th class="no-sort"></th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                    @foreach($drivers as $driver)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{ $driver->id }}</td>--}}
{{--                                            <td>{{ $driver->name }}</td>--}}
{{--                                            <td>{{ $driver->user->email }}</td>--}}
{{--                                            <td>{{ $driver->user->phone_number }}</td>--}}
{{--                                            <td>{{ $driver->user->username }}</td>--}}
{{--                                            <td>--}}
{{--                                                <button class="btn btn-info btn-sm">Non-aktif</button>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                </tbody>--}}
{{--                                <tfoot>--}}
{{--                                <tr>--}}
{{--                                    <th>ID Driver</th>--}}
{{--                                    <th>Nama Lengkap</th>--}}
{{--                                    <th>Email</th>--}}
{{--                                    <th>Telepon</th>--}}
{{--                                    <th>Nama User</th>--}}
{{--                                    <th></th>--}}
{{--                                </tr>--}}
{{--                                </tfoot>--}}
{{--                            </table>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- ============================================================== -->--}}
{{--        <!-- End PAge Content -->--}}
{{--        <!-- ============================================================== -->--}}
{{--    </div>--}}
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Segera Hadir...</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection
