
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />

    <title>Gizi Balita</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Pignose Calender -->
    <link href="/assets/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="/assets/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="/assets/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <!-- Font Awesome versi terbaru -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="#">
                    <b class="logo-abbr"><img src="images/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="./images/logo-compact.png" alt=""></span>
                    <span class="brand-title">
                        <h2 style="color: white">Gizi Balita</h2>
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a class="#" href="{{ route('dashboard') }}" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-label">Forms</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-note menu-icon"></i><span class="nav-text">Forms</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('balita.create') }}">Form Balita</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Table</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-menu menu-icon"></i><span class="nav-text">Table</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('balita.databalita') }}" aria-expanded="false">Data Balita</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Pages</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Pages</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Data Balita</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $total ?? 0}}</h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Normal</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $normal ?? 0 }}</h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">Gizi Lebih</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $lebih ?? 0 }}</h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fas fa-hamburger"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-4">
                            <div class="card-body">
                                <h3 class="card-title text-white">Gizi Kurang</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $kurang ?? 0 }}</h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fas fa-face-frown""></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-8">
                            <div class="card-body">
                                <h3 class="card-title text-white">Gizi Buruk</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $buruk ?? 0 }}</h2>
                                    <p class="text-white mb-0">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fas fa-face-sad-tear"></i></span>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- akurasi --}}
                <div class="container mt-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="card card-widget shadow-sm border-0">
                                <div class="card-body">
                                    <h5 class="text-muted mb-3">📊 Hasil Uji Akurasi Model ID3</h5>

                                    <div class="text-center mb-4">
                                        <h1 class="text-primary display-4">
                                            {{ $total > 0 ? $accuracy . '%' : '0%' }}
                                        </h1>
                                        <span class="text-muted">Akurasi Model</span>
                                    </div>

                                    <hr>

                                    <div class="mb-4 text-center">
                                        <h4 class="mb-0">{{ $total }}</h4>
                                        <small class="text-muted">Total Data Uji</small>
                                    </div>

                                    {{-- Benar --}}
                                    <div class="mb-4">
                                        <h5 class="mb-0">{{ $benar }}</h5>
                                        <div class="d-flex justify-content-between">
                                            <small class="text-success fw-bold">Klasifikasi Benar</small>
                                            <small class="text-muted">
                                                {{ $total > 0 ? round(($benar / $total) * 100, 2) . '%' : '0%' }}
                                            </small>
                                        </div>
                                        <div class="progress" style="height: 7px;">
                                            <div class="progress-bar bg-success"
                                                role="progressbar"
                                                style="width: {{ $total > 0 ? ($benar / $total) * 100 : 0 }}%;">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Salah --}}
                                    <div class="mb-4">
                                        <h5 class="mb-0">{{ $salah }}</h5>
                                        <div class="d-flex justify-content-between">
                                            <small class="text-danger fw-bold">Klasifikasi Salah</small>
                                            <small class="text-muted">
                                                {{ $total > 0 ? round(($salah / $total) * 100, 2) . '%' : '0%' }}
                                            </small>
                                        </div>
                                        <div class="progress" style="height: 7px;">
                                            <div class="progress-bar bg-danger"
                                                role="progressbar"
                                                style="width: {{ $total > 0 ? ($salah / $total) * 100 : 0 }}%;">
                                            </div>
                                        </div>
                                    </div>

                                    @if ($total == 0)
                                        <div class="alert alert-warning text-center mt-4">
                                            ⚠️ Belum ada data uji untuk menghitung akurasi.
                                        </div>
                                    @endif

                                    <a href="{{ route('balita.databalita') }}" class="btn btn-outline-secondary mt-4 w-100">
                                        ← Kembali ke Data Balita
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="#">Anggit Hardiyanto</a> 2022</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="/assets/plugins/common/common.min.js"></script>
    <script src="/assets/js/custom.min.js"></script>
    <script src="/assets/js/settings.js"></script>
    <script src="/assets/js/gleek.js"></script>
    <script src="/assets/js/styleSwitcher.js"></script>

    <!-- Chartjs -->
    <script src="/assets/plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Circle progress -->
    <script src="/assets/plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Datamap -->
    <script src="/assets/plugins/d3v3/index.js"></script>
    <script src="/assets/plugins/topojson/topojson.min.js"></script>
    <script src="/assets/plugins/datamaps/datamaps.world.min.js"></script>
    <!-- Morrisjs -->
    <script src="/assets/plugins/raphael/raphael.min.js"></script>
    <script src="/assets/plugins/morris/morris.min.js"></script>
    <!-- Pignose Calender -->
    <script src="/assets/plugins/moment/moment.min.js"></script>
    <script src="/assets/plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    <!-- ChartistJS -->
    <script src="/assets/plugins/chartist/js/chartist.min.js"></script>
    <script src="/assets/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>



    <script src="/assets/js/dashboard/dashboard-1.js"></script>

</body>

</html>
