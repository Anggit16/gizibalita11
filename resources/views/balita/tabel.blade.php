
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

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 mt-5 mb-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <!-- Tombol Create di kiri -->
                            <a href="{{ route('balita.create') }}" class="btn btn-primary mb-2">
                                <i class="ti-plus f-s-12 m-r-5"></i> Create New
                            </a>

                            <!-- Form Import CSV di tengah -->
                            <div class="mx-auto">
                                <form action="{{ route('balita.import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                                    @csrf
                                    <label class="btn btn-primary mb-0">
                                        Choose File
                                        <input type="file" name="csv_file" required style="display: none;" onchange="updateFileName(this)">
                                    </label>

                                    <!-- File name preview -->
                                    <span id="file-name" class="bg-white border rounded px-3 py-2" style="font-style: italic; min-width: 150px; display: inline-block;">
                                        No file chosen
                                    </span>


                                    <button class="btn btn-primary" type="submit">Import CSV</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ $status }}</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Umur/bln</th>
                                                <th>Berat Badan/kg</th>
                                                <th>Tinggi Badan/cm</th>
                                                <th>Status Gizi</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($balitas as $index => $balita)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $balita->nama }}</td>
                                                <td>{{ $balita->jenis_kelamin }}</td>
                                                <td>{{ $balita->umur }}</td>
                                                <td>{{ $balita->berat }}</td>
                                                <td>{{ $balita->tinggi }}</td>
                                                <td><strong>{{ $balita->status_gizi ?? '-' }}</strong></td>
                                                 <td>
                                                    <form action="{{ route('balita.destroy', $balita->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Umur/bln</th>
                                                <th>Berat Badan/kg</th>
                                                <th>Tinggi Badan/cm</th>
                                                <th>Status Gizi</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="d-flex justify-content-between mb-3">
                                        <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                            🧪 Uji Akurasi
                                        </a>

                                        <form action="{{ route('balita.destroyAll') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus SEMUA data balita?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                🗑️ Hapus Semua Data
                                            </button>
                                        </form>
                                    </div>
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
    <script src="assets/plugins/common/common.min.js"></script>
    <script src="assets/js/custom.min.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/gleek.js"></script>
    <script src="assets/js/styleSwitcher.js"></script>

    <script src="assets/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="assets/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
    <script>
        function updateFileName(input) {
            const fileName = input.files[0] ? input.files[0].name : 'No file chosen';
            document.getElementById('file-name').innerText = fileName;
        }
    </script>



</body>

</html>
