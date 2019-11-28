@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        @include('partials.table', [
                            'thead' => [
                                'Username',
                                'Email',
                                'Status',
                                'Aksi'
                            ],
                            'datas' => $users->map(function ($item) {
                                return [
                                    $item->username,
                                    $item->email,
                                    $item->status ? $item->status->name : '-',
                                    (check_status($item->status_id, 'AKTIF')
                                        ? '<button data-id="'.$item->id.'" class="btn btn-secondary btn-sm" >Non-aktif</button>'
                                        : '<button data-id="'.$item->id.'" class="btn btn-primary btn-sm" >Aktif</button>'
                                        ).
                                    '
                                    <button class="btn btn-info btn-sm">Kelola</button>
                                    '
                                ];
                            }),
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="toggle-status" action="" method="POST" class="d-none">
        @method('PUT')
        @csrf
    </form>
@stop
@section('extra-script')
    <script>
        $(function() {
            $("table button").on("click", function(e) {
                var id = $(e.target).data('id');
                var form = $("#toggle-status");

                form.attr("action", "{!! route('admin.user.toggle', '') !!}/"+id);
                form.submit();
            });
        });
    </script>
@stop
