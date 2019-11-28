<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <link href="{{ asset('matrix/assets/libs/flot/css/float-chart.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('matrix/assets/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('matrix/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link href="{{ asset('matrix/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css" rel="stylesheet">
    {{--<link href="{{ asset('matrix/assets/libs/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet" />--}}
    <link href="{{ asset('matrix/assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('matrix/dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/callendar.css') }}" rel="stylesheet">
    <style>
        .datepicker table tr td span.active{
            background: #04c!important;
            border-color: #04c!important;
        }
        .datepicker .datepicker-days tr td.active {
            background: #04c!important;
        }
        #week-picker-wrapper .datepicker .datepicker-days tr td.active~td, #week-picker-wrapper .datepicker .datepicker-days tr td.active {
            color: #fff;
            background-color: #04c;
            border-radius: 0;
        }

        #week-picker-wrapper .datepicker .datepicker-days tr:hover td, #week-picker-wrapper .datepicker table tr td.day:hover, #week-picker-wrapper .datepicker table tr td.focused {
            color: #000!important;
            background: #e5e2e3!important;
            border-radius: 0!important;
        }

        th {
            font-weight: 700 !important;
            font-size: 0.75rem !important;
        }

        .table td, .table th {
            padding: 0.625rem !important;
        }

        table.dataTable {
            margin-top: 20px !important;
            margin-bottom: 20px !important;
        }

        .dataTables_empty p {
            margin: 0;
            padding-top: 15px !important;
            padding-bottom: 15px !important;
        }
        .file-drag-wrapper {
            position: relative;
            width: 100%;
            height: 240px;
            border: 1px dashed #ccc;
        }
        .file-drag {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
        }
        .badge-notification {
            position: relative;
            margin-right: 10px;
        }
        .badge-notification[data-badge]::after {
            content: attr(data-badge);
            position: absolute;
            top: -11px;
            right: -10px;
            display: flex;
            justify-content: center;
            align-content: center;
            width: 22px;
            height: 22px;
            line-height: 22px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 50%;
            background: var(--danger);
            color: #fff;
        }
        span.badge-notification {
            margin-right: 24px;
        }
        span.badge-notification[data-badge]::after {
            top: -11px;
            right: -24px;
        }

        span.no-el.badge-notification[data-badge]::after {
            top: 0px;
            right: -26px;
        }
        .nav-tabs .nav-item .nav-link.active {
            font-weight: bold !important;
            color: var(--dark) !important;
        }
        .nav-tabs .nav-item .nav-link {
            color: var(--secondary) !important;
        }
        .dtr-details ul li {
            word-break: break-all;
        }
        .nav-pills.dompet .nav-item .nav-link.active {
            color: var(--light) !important;
        }
        .nav-pills.dompet .nav-item .nav-link {
            color: var(--secondary) !important;
        }
        .nav-pills.dompet .nav-item {
            margin-bottom: 10px;
            background-color: var(--light);
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>
<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header" data-logobg="skin5">
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <a class="navbar-brand" href="{{ url('banksampah') }}">
                    <b class="logo-icon">
                        <!-- Dark Logo icon -->
                        <img style="width: 42px" src="{{ asset('gonigoni_icon.png') }}" alt="homepage" class="light-logo" />

                    </b>
                    <!-- Logo text -->
                    <span class="logo-text">
                        <!-- dark Logo text -->
                         <img style="width: 130px" src="{{ asset('gonigoni_text.png') }}" alt="homepage" class="light-logo" />

                    </span>
                </a>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Toggle which is visible on mobile only -->
                <!-- ============================================================== -->
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-left mr-auto">
                    <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>

                    <!-- ============================================================== -->
                    <!-- Search -->
                    <!-- ============================================================== -->
                    {{--<li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                        <form class="app-search position-absolute">
                            <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                        </form>
                    </li>--}}
                </ul>
                <!-- ============================================================== -->
                <!-- Right side toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-right">
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="holder.js/31x31?theme=sky&text=A" alt="user" class="rounded-circle mr-2">
                            {{ auth()->user()->username ?? auth()->user()->username }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right user-dd animated">
                            {{--<a class="dropdown-item" href="{{ route('banksampah.profile') }}"><i class="ti-user m-r-5 m-l-5"></i> Profil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('banksampah.account.edit') }}"><i class="ti-settings m-r-5 m-l-5"></i> Pengaturan Akun</a>
                            <div class="dropdown-divider"></div>--}}
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-power-off m-r-5 m-l-5"></i> Keluar</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin5">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav" class="p-t-30">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.index') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dasbor</span></a></li>
                    {{--<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.accounts') }}" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Akun</span></a></li>--}}
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.wallet') }}" aria-expanded="false"><i class="mdi mdi-wallet badge-notification" {{ auth()->user()->unreadNotifications->isNotEmpty() ? 'data-badge='. auth()->user()->unreadNotifications->count() : '' }}></i><span class="hide-menu">Dompet</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.banksampah') }}" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Bank Sampah</span></a></li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
    @yield('content')
    <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center d-flex align-items-center justify-content-between" style="padding-top: 32px">
            All Rights Reserved by Gonigoni.
            <small class="d-block text-center">Theme by <a href="https://wrappixel.com" class="text-muted">WrapPixel</a></small>
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ asset('matrix/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('matrix/dist/js/jquery.ui.touch-punch-improved.js') }}"></script>
<script src="{{ asset('matrix/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('matrix/dist/js/jquery-ui.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('matrix/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('matrix/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('matrix/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('matrix/assets/extra-libs/sparkline/sparkline.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('matrix/dist/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('matrix/dist/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('matrix/dist/js/custom.min.js') }}"></script>
<!--This page JavaScript -->
<script src="{{ asset('matrix/assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
<script src="{{ asset('matrix/assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
<script src="{{ asset('matrix/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('matrix/assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('matrix/assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('matrix/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('matrix/assets/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('matrix/assets/libs/moment/locale/id.js') }}"></script>
<script src="{{ asset('matrix/assets/libs/toastr/build/toastr.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/holderjs@2.9.6"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
@yield('extra-script')
<script>
    moment.locale('id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var dataTableOptions = {
        responsive: {
            details: {
                type: 'column'
            },
        },
        autoWidth: false,
        columnDefs: [
            { targets: 'no-sort', orderable: false },
            {
                className: 'control',
                orderable: false,
                targets: 0,
            },
        ],
        order: [],
        language: {
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            paginate: {
                next: "Selanjutnya",
                previous: "Sebelumnya"
            },
            search: "Cari",
            infoEmpty: "<span>Tidak ada entri yang tersedia</span>",
            lengthMenu: "Tampilkan _MENU_ entri",
            emptyTable: "<p>Tidak ada data yang tersedia dalam tabel</p>",
            sZeroRecords: "Tidak ada data yang cocok ditemukan"
        }
    };

    $('#zero_config').attr({
        style: 'width: 100%;',
        cellspacing: 0,
    }).DataTable(dataTableOptions);

    $('#zero_config1').attr({
        style: 'width: 100%;',
        cellspacing: 0,
    }).DataTable(dataTableOptions);

    $('#zero_config2').attr({
        style: 'width: 100%;',
        cellspacing: 0,
    }).DataTable(dataTableOptions);

    $(".zero_config").attr({
        style: 'width: 100%;',
        cellspacing: 0,
    }).each(function() {
        $(this).DataTable(dataTableOptions);
    });

    $(document).ready(function() {
        $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
            // var target = $(e.target).attr("href"); // activated tab
            // alert (target);
            $($.fn.dataTable.tables(true)).css('width', '100%');
            $($.fn.dataTable.tables(true)).DataTable().responsive.recalc().columns.adjust().draw();
        } );
    });

    function initializeSelect2(obj) {
        obj.select2({
            placeholder: obj.attr('placeholder'),
            width: '100%'
        });
    }

    $(".select2").each(function() {
        initializeSelect2($(this));
    });
</script>
</body>
</html>
