<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1">
    <meta name="theme-color" content="#999a38">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/matrix/assets/images/favicon.png">
    <link href="{{ asset('matrix/assets/libs/flot/css/float-chart.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <script>
        var ktSampah = 0;


        @foreach($kategorisampahs ?? [] as $kategorisampah)
            ktSampah++;
        @endforeach
    </script>
    <link rel="stylesheet" type="text/css" href="{{ asset('matrix/assets/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('matrix/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link href="{{ asset('matrix/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css" rel="stylesheet">
    {{--<link href="{{ asset('matrix/assets/libs/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet" />--}}
    <link href="{{ asset('matrix/assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('matrix/dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/callendar.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
        .nav-pills.dompet .nav-item .nav-link.active, .nav-pills.finansial .nav-item .nav-link.active {
            color: var(--light) !important;
        }
        .nav-pills.dompet .nav-item .nav-link, .nav-pills.finansial .nav-item .nav-link {
            color: var(--secondary) !important;
        }
        .nav-pills.dompet .nav-item, .nav-pills.finansial .nav-item {
            margin-bottom: 10px;
            background-color: var(--light);
        }
        table.dataTable.dtr-column>tbody>tr>td.control, table.dataTable.dtr-column>tbody>tr>th.control {
            min-width: 18px;
            min-height: 20px;
        }
        table.dataTable>tbody>tr.child span.dtr-title {
            white-space: normal;
            width: 100px !important;
        }
        .dataTables_wrapper.container-fluid {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        td.nowrap {
            white-space: nowrap;
        }
        .sick-wrapper {
            min-height: 100vh;
            position: relative; }
        .sick-wrapper .auth-box {
            background: #fff;
            padding: 20px;
            -webkit-box-shadow: 1px 0px 20px rgba(0, 0, 0, 0.08);
            box-shadow: 1px 0px 20px rgba(0, 0, 0, 0.08);
            max-width: 400px;
            width: 90%;
            margin: 10% 0; }
        .sick-wrapper .auth-box .logo {
            text-align: center; }
        .sick-wrapper .auth-box.on-sidebar {
            top: 0px;
            right: 0px;
            height: 100%;
            margin: 0px;
            position: absolute; }
        .sick-wrapper #recoverform {
            display: none; }
        .sick-wrapper .auth-sidebar {
            position: fixed;
            height: 100%;
            right: 0px;
            overflow: auto;
            margin: 0px;
            top: 0px; }

        @media (max-width: 767px) {
            .sick-wrapper .auth-sidebar {
                position: relative;
                max-width: 100%;
                width: 100%;
                margin: 40px 0 60px; }
            .sick-wrapper .demo-text {
                margin-top: 30px; } }
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
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img style="width: 42px" src="{{ asset('gonigoni_icon.png') }}" alt="homepage" class="light-logo" />

                        </b>
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                             <img style="width: 130px" src="{{ asset('gonigoni_text.png') }}" alt="homepage" class="light-logo" />

                        </span>
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon"> -->
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <!-- <img src="../../assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                        <!-- </b> -->
                        <!--End Logo icon -->
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
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        {{--<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>--}}
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        {{--<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-24 mdi mdi-comment-processing"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Event today</h5>
                                                        <span class="mail-desc">Just a reminder that event</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Settings</h5>
                                                        <span class="mail-desc">You can customize this template</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Pavan kumar</h5>
                                                        <span class="mail-desc">Just see the my admin!</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-danger btn-circle"><i class="fa fa-link"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Luanch Admin</h5>
                                                        <span class="mail-desc">Just see the my new admin!</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>--}}
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="holder.js/31x31?theme=sky&text={{ auth()->user()->name_abbr }}" alt="user" class="rounded-circle mr-2">
                                {{ auth()->user()->name ?? auth()->user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a class="dropdown-item" href="{{ route('banksampah.profile') }}"><i class="ti-user m-r-5 m-l-5"></i> Profil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('banksampah.account.edit') }}"><i class="ti-settings m-r-5 m-l-5"></i> Pengaturan Akun</a>
                                <div class="dropdown-divider"></div>
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
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('banksampah') }}" aria-expanded="false">
                                <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        {{--<li class="sidebar-item @cannot('viewAny', App\Nasabah::class) d-none @endcannot"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('banksampah/nasabah') }}" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Nasabah</span></a></li>
                        <li class="sidebar-item @cannot('viewAny', App\Pegawai::class) d-none @endcannot"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('banksampah/pegawai') }}" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Pegawai</span></a></li> --}}
                        {{--<li class="sidebar-item @cannot('viewAny', App\Driver::class) d-none @endcannot"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('banksampah/driver') }}" aria-expanded="false"><i class="mdi mdi-car"></i><span class="hide-menu">Driver</span></a></li>--}}
                        <li class="sidebar-item @cannot('viewAny', App\Kategorisampah::class) d-none @endcannot"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('banksampah/kategori-sampah') }}" aria-expanded="false"><i class="mdi mdi-tag"></i><span class="hide-menu">Kategori Sampah</span></a></li>
                        <li class="sidebar-item @cannot('viewAny', App\Setoran::class) d-none @endcannot"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-leaf"></i><span class="hide-menu">Transaksi Sampah </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ url('banksampah/setoran') }}" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> Setoran </span></a></li>
                            <li class="sidebar-item"><a href="{{ url('banksampah/sampah-keluar') }}" class="sidebar-link"><i class="mdi mdi-forward"></i><span class="hide-menu"> Sampah Keluar </span></a></li>
                        </ul>
                        </li>
                        {{--<li class="sidebar-item @cannot('viewAny', App\Jadwal::class) d-none @endcannot"><a href="{{ url('banksampah/jemput') }}" class="waves-effect waves-dark sidebar-link"><i class="mdi mdi-car"></i><span class="hide-menu"> Setoran Jemput </span></a></li>
                        <li class="sidebar-item @cannot('viewAny', App\Kategorisampah::class) d-none @endcannot"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('banksampah/kategori-sampah/stok') }}" aria-expanded="false"><i class="mdi mdi-package-variant"></i><span class="hide-menu">Stok</span></a></li>
                        <li class="sidebar-item @cannot('viewAny', App\SetoranPayment::class) d-none @endcannot">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('banksampah/dompet') }}" aria-expanded="false">
                                <i class="mdi mdi-wallet badge-notification" {{ banksampah()->unreadNotifications->isNotEmpty() ? 'data-badge='. banksampah()->unreadNotifications->count() : '' }}></i><span class="hide-menu">Dompet</span>
                            </a>
                        </li>
                        <li class="sidebar-item @cannot('viewAny', [App\Setoran::class, App\Sampahkeluar::class]) d-none @endcannot"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('finansial.index') }}" aria-expanded="false"><i class="mdi mdi-cash-multiple"></i><span class="hide-menu">Finansial</span></a></li>
                        <li class="sidebar-item bg-success mt-5"> <a class="sidebar-link waves-effect waves-dark font-bold sidebar-link" target="_blank" href='https://api.whatsapp.com/send?phone=6282215561533&text={{ rawurlencode("Kode: JSX-". rand(100, 999) ."\nNama Bank Sampah: " . banksampah()->name . "\nAlamat: " . banksampah()->user->alamat->address) }}' aria-expanded="false"><i class="mdi mdi-cart"></i><span class="hide-menu">Jual Sampah</span></a></li> --}}
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
    <script>
        var bsId = {!! json_encode(banksampah()->id) !!};
        var jemputData;
    </script>
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
    <script src="{{ asset('js/callendar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/holderjs@2.9.6"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    @yield('extra-script')
    <script>
        $(function() {
            /*$.fn.modal.Constructor.Default.keyboard = false;
            $.fn.modal.Constructor.Default.backdrop = 'static';*/

            $('.modal').attr({
                tabindex: "-1",
                role: "dialog",
            })
        });

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
                infoFiltered: "<span>(difilter dari _MAX_ total entri)</span>",
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
                width: '100%',
            });
        }

        $(".select2").each(function() {
            initializeSelect2($(this));
        });

        $(function(){
            $("#addAnotherInput").click(function() {
                var form = $("#addForm .form-group.row:last");
                if (ktSampah > 0) {
                    var addedForm = $(form
                        .clone(true)
                        .insertAfter("#addForm .form-group.row:last"));
                    addedForm.find("button").removeClass("d-none");
                    addedForm.find("input").val(null);
                    addedForm.find("option").removeAttr("selected");
                    form.find("input").removeClass("is-invalid");
                    form.find("select").removeClass("is-invalid");
                    form.find("option").removeClass("is-invalid");
                    ktSampah--;
                }
            });
        });

        $(function() {
            $("#addAnotherInputEdit").click(function () {
                var form = $("#editSetoranForm .form-group.row:last");
                if (ktSampah > 0) {
                    var addedForm = $(form
                        .clone(true)
                        .insertAfter("#editSetoranForm .form-group.row:last"));
                    addedForm.find("button").removeClass("d-none").attr("readonly", false);
                    addedForm.find("input").val(null).attr("readonly", false);
                    addedForm.find("select").attr("readonly", false);
                    addedForm.find("option").removeAttr("selected");
                    addedForm.find("option").attr({readonly: false, disabled: false});
                    addedForm.find("select[name='setoran_detail_status[]']").find("option:nth(1)").attr("selected","selected");
                    addedForm.find("input").removeClass("is-invalid");
                    addedForm.find(".invalid-feedback").removeClass("d-block");
                    addedForm.find("select").removeClass("is-invalid");
                    addedForm.find("option").removeClass("is-invalid");
                    ktSampah--;
                }
            });
        });

        $(function() {
            /*var setoran_detail_status = $("select[name='setoran_detail_status[]']");*/
            var selesaiBtn = $("input[value=9]").parent();
            var rejectBtn = $("input[value=11]").parent();

            $("select[name='sampahkeluar_detail_status[]']").on("change", function(e) {
                var harga = $(this).parent().prev().find("input");
                var berat = harga.parent().prev().find("input");
                var katSampah = berat.parent().parent().prev().find("select");

                if (this.value === "9" || this.value === "11") {
                    harga.attr("readonly", "readonly");
                    berat.attr("readonly", "readonly");
                    katSampah.attr("readonly", "readonly");
                    katSampah.find("option:not(:selected)").attr("disabled", "disabled");
                } else {
                    harga.attr("readonly", false);
                    berat.attr("readonly", false);
                    katSampah.attr("readonly", false);
                    katSampah.find("option:not(:selected)").attr("disabled", false);
                }

                var $reject = $("select[name='sampahkeluar_detail_status[]']").filter(function() {
                    return this.value == 11;
                });

                var $belumselesai = $("select[name='sampahkeluar_detail_status[]']").filter(function() {
                    return this.value == 10;
                });

                if ($belumselesai.length !== 0) {
                    $("#Selesai9").prop("checked", false);
                    $("#Reject11").prop("checked", false);
                } else if ($reject.length === $("select[name='sampahkeluar_detail_status[]']").length) {
                    $("#Reject11").prop("checked", "checked");
                } else {
                    $("#Selesai9").prop("checked", "checked");
                }

                /*if ($reject.length === 0) {
                    $("#Reject11").attr("checked", "checked");
                } else {
                    $("#Reject11").attr("checked", false);
                }*/
            });

            $("select[name='sampahkeluar_detail_status[]']").each(function() {
                $(this).trigger("change");
            });

            $("select[name='setoran_detail_status[]']").on("change", function(e) {

                var harga = $(this).parent().prev().find("input");
                var berat = harga.parent().parent().prev().find("input");
                var katSampah = berat.parent().parent().prev().find("select");

                if (this.value === "9" || this.value === "11") {
                    harga.attr("readonly", "readonly");
                    berat.attr("readonly", "readonly");
                    katSampah.attr("readonly", "readonly");
                    katSampah.find("option:not(:selected)").attr("disabled", "disabled");
                } else {
                    harga.attr("readonly", false);
                    berat.attr("readonly", false);
                    katSampah.attr("readonly", false);
                    katSampah.find("option:not(:selected)").attr("disabled", false);
                }

                var $reject = $("select[name='setoran_detail_status[]']").filter(function() {
                    return this.value == 11;
                });

                var $belumselesai = $("select[name='setoran_detail_status[]']").filter(function() {
                    return this.value == 10;
                });

                if ($belumselesai.length !== 0) {
                    $("#Selesai9").prop("checked", false);
                    $("#Reject11").prop("checked", false);
                } else if ($reject.length === $("select[name='setoran_detail_status[]']").length) {
                    $("#Reject11").prop("checked", "checked");
                } else {
                    $("#Selesai9").prop("checked", "checked");
                }

                /*if ($reject.length === 0) {
                    $("#Reject11").attr("checked", "checked");
                } else {
                    $("#Reject11").attr("checked", false);
                }*/
            });

            $("select[name='setoran_detail_status[]']").each(function() {
                $(this).trigger("change");
            });

            selesaiBtn.click(function() {
                $("select[name='setoran_detail_status[]']").each(function() {
                    $(this).val(9).trigger("change");
                });

                $("select[name='sampahkeluar_detail_status[]']").each(function() {
                    $(this).val(9).trigger("change");
                });
            });

            rejectBtn.click(function() {
                $("select[name='setoran_detail_status[]']").each(function() {
                    $(this).val(11).trigger("change");
                });

                $("select[name='sampahkeluar_detail_status[]']").each(function() {
                    $(this).val(11).trigger("change");
                });
            });
        });

        $("#datepicker-autoclose").datepicker({
            autoclose: true,
            todayHighlight: true,
            endDate: new Date,
            format: 'dd/mm/yyyy'
        });

        $("#datepicker-autoclose-aman").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy'
        });

        $(function() {
            var date = new Date();
            date.setDate(date.getDate()+1);
            $("#datepicker-disable-old").datepicker({
                autoclose: true,
                startDate: date,
                format: 'dd/mm/yyyy'
            });
        });

        $("#detailSetoranModal").on("show.bs.modal", function(event) {
            var detailSetoranId = $(event.relatedTarget).data("id");

            $.ajax({
                type: "POST",
                url: "{!! url('api/setorans/') !!}"+"/"+detailSetoranId,
                data: {
                    banksampah_id: {!! auth()->user()->banksampah->id ?? auth()->user()->pegawai->banksampah->id !!}
                },
                success: function(data) {
                    console.log(data);
                    $("#detailSetoranTitle").text("Detail Setoran ("+data[0].id_pretty+")");
                    $("#detailSetoranBiayaSetoran").text("Rp "+data[0].store_cost_rp ? data[0].store_cost_rp : 0);
                    $("#detailSetoranTotalSetoran").text("Rp "+data[0].price_total_nett_rp);
                    $("#detailSetoranTableHead").append(
                        "<tr>"+
                            "<th>Jenis Sampah</th>"+
                            "<th>Golongan</th>"+
                            "<th>Harga Setor (Rp)</th>"+
                            "<th>Berat (Kg)</th>"+
                            "<th>Sub Total (Rp)</th>"+
                            "<th>Status</th>"+
                        "</tr>"
                    );
                    $(data[0].setoran_detail).each(function(index, value) {
                        $("#detailSetoranTableBody").append(
                            "<tr>"+
                                "<td>"+value.kategorisampah.code+"</td>"+
                                "<td>"+value.kategorisampah.name+"</td>"+
                                "<td>"+value.store_price_rp+"</td>"+
                                "<td class='text-right'>"+value.weight+"</td>"+
                                "<td>"+value.sub_total_rp+"</td>"+
                                "<td>"+value.status.name+"</td>"+
                            "</tr>"
                        );
                    });
                }
            });
        });

        // Reset tabel detail modal setelah modal tertutup
        $("#detailSetoranModal").on("hidden.bs.modal", function(event) {
            $("#detailSetoranTableHead").empty();
            $("#detailSetoranTableBody").empty();
        });

        $("#detailSampahkeluarModal").on("show.bs.modal", function(event) {
            var detailSampahkeluarId = $(event.relatedTarget).data("id");

            $.ajax({
                type: "POST",
                url: "{{ url('api/sampah-keluar/') }}"+"/"+detailSampahkeluarId,
                data: {
                    banksampah_id: {{ auth()->user()->banksampah->id ?? auth()->user()->pegawai->banksampah->id }}
                },
                success: function(data) {
                    $("#detailSampahkeluarTitle").text("Detail Sampah Keluar ("+data[0].id_pretty+")");
                    $("#detailSampahkeluarBiaya").text("Rp "+data[0].extra_cost_rp ? data[0].extra_cost_rp : 0);
                    $("#detailSampahkeluarTotal").text("Rp "+data[0].price_total_nett_rp);
                    $("#detailSampahkeluarTableHead").append(
                        "<tr>"+
                        "<th>Jenis Sampah</th>"+
                        "<th>Golongan</th>"+
                        "<th>Harga Jual (Rp)</th>"+
                        "<th>Berat (Kg)</th>"+
                        "<th>Sub Total (Rp)</th>"+
                        "<th>Status</th>"+
                        "</tr>"
                    );
                    $(data[0].sampahkeluar_detail).each(function(index, value) {
                        $("#detailSampahkeluarTableBody").append(
                            "<tr>"+
                            "<td>"+value.kategorisampah.code+"</td>"+
                            "<td>"+value.kategorisampah.name+"</td>"+
                            "<td>"+value.price_rp+"</td>"+
                            "<td class='text-right'>"+value.weight+"</td>"+
                            "<td>"+value.sub_total_rp+"</td>"+
                            "<td>"+value.status.name+"</td>"+
                            "</tr>"
                        );
                    });
                }
            });
        });

        // Reset tabel detail modal setelah modal tertutup
        $("#detailSampahkeluarModal").on("hidden.bs.modal", function(event) {
            $("#detailSampahkeluarTableHead").empty();
            $("#detailSampahkeluarTableBody").empty();
        });

        var ktSid = null;

        function deleteParent(event) {
            var mmxA = event.target.parentNode.parentNode;
            mmxA.parentNode.removeChild(mmxA);
        }

        var urlParams = new URLSearchParams(window.location.search);

        $(function() {
            var max = new Date().getFullYear(),
                min = max - 5;
            var tahunSelect = $(".tahun-select");
            var data = [];
            for (var i = max; i >= min; i--){
                data.push({
                    id: i,
                    text: i
                });
            }

            tahunSelect.select2({
                data: data
            }).on("select2:select", function(e) {
                var startDate = moment(e.params.data.id, "YYYY").startOf('year').format("DD-MM-YYYY");
                var endDate = moment(e.params.data.id, "YYYY").endOf('year').format("DD-MM-YYYY");
                window.location.href = window.location.origin+window.location.pathname+"?tab=tahun&start="+startDate+"&end="+endDate;
            });

            if (urlParams.get("start")) {
                console.log(tahunSelect.val(urlParams.get("start").split("-")[2]).trigger("change"));
            }
        });

        $(function() {
            var bulanSelect = $(".bulan-select");
            var dataBulan = [
                {
                    id: 0,
                    text: 'Pilih bulan...'
                }
            ];
            moment.months().forEach(function(item, index) {
                dataBulan.push({
                    id: String(index+1).padStart(2, "0"),
                    text: item
                });
            });

            var max = new Date().getFullYear(),
                min = max - 5;
            var tahunBulanSelect = $(".tahun-bulan-select");
            var dataTahun = [];
            for (var i = max; i >= min; i--){
                dataTahun.push({
                    id: i,
                    text: i
                });
            }

            var startDate, endDate, stDt;

            bulanSelect.select2({
                width: "100%",
                data: dataBulan
            }).on("select2:select", function(e) {
                startDate = moment(e.params.data.id+"-"+tahunBulanSelect.val(), "MM-YYYY").startOf('month').format("DD-MM-YYYY");
                endDate = moment(e.params.data.id+"-"+tahunBulanSelect.val(), "MM-YYYY").endOf('month').format("DD-MM-YYYY");
                window.location.href = window.location.origin+window.location.pathname+"?tab=bulan&start="+startDate+"&end="+endDate;
            });

            tahunBulanSelect.select2({
                width: "100%",
                data: dataTahun
            }).on("select2:select", function(e) {
                startDate = moment(bulanSelect.val()+"-"+e.params.data.id, "MM-YYYY").startOf('month').format("DD-MM-YYYY");
                endDate = moment(bulanSelect.val()+"-"+e.params.data.id, "MM-YYYY").endOf('month').format("DD-MM-YYYY");
                window.location.href = window.location.origin+window.location.pathname+"?tab=bulan&start="+startDate+"&end="+endDate;
            });

            if (urlParams.get("start")) {
                stDt = urlParams.get("start").split("-");
                bulanSelect.val(stDt[1]).trigger("change");
                tahunBulanSelect.val(stDt[2]).trigger("change");
            } else {
                bulanSelect.val(moment().format("MM")).trigger("change");
            }
        });

        var stokId = 0;

        $(function() {
            var modal = $("#residuModal");
            var input = modal.find("input[name=weight]");

            modal.on("show.bs.modal", function(event) {
                var btn = $(event.relatedTarget);
                var id = btn.data("katid");
                var action = btn.data("action");

                $("#residuSampahForm").attr({
                    action: action
                });

                if (input.val() !== "") {
                    modal.find("button.btn-primary").attr("disabled", false);
                }
            });

            input.on("input", function() {
                if (input.val() !== "") {
                    modal.find("button.btn-primary").attr("disabled", false);
                } else {
                    modal.find("button.btn-primary").attr("disabled", "disabled");
                }
            });
        });

        toastr.options = {
            "positionClass": "toast-bottom-left",
        };

        $(function() {
            var weekpicker, start_date, end_date;

            function set_week_picker(date, a = null) {
                var urlParams = new URLSearchParams(window.location.search);
                /*start_date = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
                end_date = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());*/
                start_date = moment(date).startOf('week').toDate();
                end_date = moment(date).endOf('week').toDate();
                if (urlParams.get("start") && urlParams.get("end")) {
                    var sDate = moment(urlParams.get("start"), "DD-MM-YYYY").format("DD/MM/YYYY");
                    var eDate = moment(urlParams.get("end"), "DD-MM-YYYY").format("DD/MM/YYYY");
                    weekpicker.datepicker('update', moment(urlParams.get("start"), "DD-MM-YYYY").toDate());

                    weekpicker.val(sDate + ' - ' + eDate);
                } else {
                    weekpicker.datepicker('update', start_date);
                    weekpicker.val(start_date.getDate() + '/' + (start_date.getMonth() + 1) + '/' + start_date.getFullYear() + ' - ' + end_date.getDate() + '/' + (end_date.getMonth() + 1) + '/' + end_date.getFullYear());
                }

                var startDate = moment(start_date).format('DD-MM-YYYY');
                var endDate = moment(end_date).format('DD-MM-YYYY');

                if (a) {
                    window.location.href = window.location.origin+window.location.pathname+"?tab="+urlParams.get("tab")+"&start="+startDate+"&end="+endDate;
                }
            }
            weekpicker = $('.week-picker');
            weekpicker.datepicker({
                weekStart: 1,
                autoclose: true,
                forceParse: false,
                container: '#week-picker-wrapper',
            }).on("changeDate", function(e) {
                set_week_picker(e.date, 1);
            });
            $('.week-prev').on('click', function() {
                var prev = new Date(start_date.getTime());
                prev.setDate(prev.getDate() - 1);
                set_week_picker(prev, 1);
            });
            $('.week-next').on('click', function() {
                var next = new Date(end_date.getTime());
                next.setDate(next.getDate() + 1);
                set_week_picker(next, 1);
            });
            set_week_picker(new Date);
        });

        $(function() {
            var cal = $("#harianCalendar");
            var startDate, endDate;

            cal.datepicker({
                format: 'dd/mm/yyyy',
            }).on("changeDate", function (e) {
                startDate = moment(e.date).startOf('day').format("DD-MM-YYYY");
                endDate = moment(e.date).endOf('day').format("DD-MM-YYYY");
                window.location.href = window.location.origin+window.location.pathname+"?start="+startDate+"&end="+endDate;
            });

            if (urlParams.get("start")) {
                cal.val(urlParams.get("start").split("-").join("/"));
                cal.datepicker("update", urlParams.get("start").split("-").join("/"));
            }
        });

        $(function() {
            var cal = $("#rangeCalendar");
            var startDate, endDate;

            cal.daterangepicker({
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month'),
                locale: {
                    cancelLabel: 'Batal',
                    applyLabel: 'Cari',
                    format: 'DD MMM YYYY'
                },
            }).on("apply.daterangepicker", function (ev, picker) {
                startDate = picker.startDate.format('DD-MM-YYYY');
                endDate = picker.endDate.format('DD-MM-YYYY');
                window.location.href = window.location.origin+window.location.pathname+"?start="+startDate+"&end="+endDate;
            });

            if (urlParams.get("start")) {
                cal.val(moment(urlParams.get("start"), "DD-MM-YYYY"));
                cal.data('daterangepicker').setStartDate(moment(urlParams.get("start"), "DD-MM-YYYY"));
                cal.data('daterangepicker').setEndDate(moment(urlParams.get("end"), "DD-MM-YYYY"));
            }
        });

       $(function() {
            var select = $("#setoranType").select2();
            $(function() {
                select.trigger({
                    type: 'select2:select',
                    params: {
                        data: {
                            id: $("#setoranType").val(),
                        }
                    }
                });
            });
            select.on("select2:select", function(e) {
                var data = e.params.data;
                if (data.id === "beli") {
                    var kategorisampahForm = $("div.form-group.row.kategori-sampah");
                    kategorisampahForm.find("div.col-md-9.kategori-sampah.create").removeClass("col-md-9").addClass("col-md-6");
                    kategorisampahForm.find("div.col-md-6.kategori-sampah.edit").removeClass("col-md-6").addClass("col-md-3");
                    kategorisampahForm.find("div.col-md-3").removeClass("d-none");
                } else {
                    var kategorisampahForm = $("div.form-group.row.kategori-sampah");
                    kategorisampahForm.find("div.col-md-6.kategori-sampah.create").removeClass("col-md-6").addClass("col-md-9");
                    kategorisampahForm.find("div.col-md-3.kategori-sampah.edit").removeClass("col-md-3").addClass("col-md-6");
                    kategorisampahForm.find("div.col-md-3.harga").addClass("d-none");
                }
            });
        });

        @if (session('status'))
        $(function() {
            toastr.success('{!! session('status') !!}');
        });
        @endif

        @if (session('danger'))
        $(function() {
            toastr.error('{!! session('danger') !!}');
        });
        @endif
    </script>
    @if($errors->any())
    <script>
        $(".modal:not(#confirmDeleteModal, " +
            "#deactivateModal, " +
            "#detailKategorisampahModal, " +
            "#editPegawaiModal, " +
            "#addBankAccountConfirmModal)").modal("toggle");

        $(".modal").on("hide.bs.modal", function() {
            $(this).find(".is-invalid").removeClass("is-invalid");
            $(this).find("input[name!='_token']").removeAttr("value");
        });
    </script>
    @endif
</body>
</html>
