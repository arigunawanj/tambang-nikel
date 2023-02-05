<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tambang Nikel | @yield('title')</title>

    <!-- Custom fonts for this template-->
    {{-- <link href="{{ asset('data/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="icon" href="{{ asset('data/img/undraw_rocket.svg') }}">
    <!-- Custom styles for this template-->
    <link href="{{ asset('data/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="{{ asset('data/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-landmark"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Nikel <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
                <a class="nav-link" href="/home">
                    <i class="fas fa-fw fa-house-user"></i>
                    <span>Beranda</span></a>
            </li>
            <li class="nav-item {{ request()->is('activity') ? 'active' : '' }}">
                @if (Auth::user()->role == 'Control')
                <a class="nav-link" href="/activity">
                    <i class="fa-solid fa-shoe-prints"></i>
                    <span>Log Aktivitas</span></a>
                @endif
            </li>

            <!-- Divider -->
            @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Control')
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Atasan
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fa-solid fa-file-waveform"></i>
                        <span>Pendataan</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Pendataan</h6>
                            <a class="collapse-item {{ request()->is('kendaraan') ? 'active' : '' }}" href="/kendaraan">Data
                                Kendaraan</a>
                            <a class="collapse-item {{ request()->is('driver') ? 'active' : '' }}"
                                href="/driver">Data Driver</a>
                            @if (Auth::user()->role == 'Control')
                                <a class="collapse-item {{ request()->is('user') ? 'active' : '' }}" href="/user">Data
                                Pengguna</a>
                            @endif
                        </div>
                    </div>
                </li>
            @endif


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Sewa
            </div>


            <li class="nav-item {{ request()->is('sewa') ? 'active' : '' }}">
                <a class="nav-link" href="/sewa">
                    <i class="fa-solid fa-car"></i>
                    <span>Sewa Kendaraan</span></a>
            </li>
            <li class="nav-item {{ request()->is('riwayat') ? 'active' : '' }}">
                <a class="nav-link" href="/riwayat">
                    <i class="fa-solid fa-clone"></i>
                    <span>Riwayat Peminjaman</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    {{-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> --}}

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>


                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('data/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('main')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Ari Gunawan Jatmiko &copy; Tambang Nikel @php
                            $tahun = date('Y');
                        @endphp {{ $tahun }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin mau pergi ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih Tombol "Logout" kalau kamu udah yakin</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><i
                            class="fa-solid fa-xmark"></i> Batal</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('data/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('data/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('data/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('data/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('data/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('data/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('data/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('data/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('data/js/demo/chart-pie-demo.js') }}"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('data/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('data/js/harga.js') }}"></script>
    
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @elseif (Session::has('error'))
            toastr.error("{{ Session::get('error') }}")
        @endif
    </script>
    <script>
        window.onload = function() {
        
        var dataPoints = [];
        
        var chart = new CanvasJS.Chart("chartku", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Riwayat Peminjaman"
            },
            axisY: {
                title: "Status",
                titleFontSize: 22,
                includeZero: true
            },
            data: [{
                type: "column",
                yValueFormatString: "#,### Terpakai",
                dataPoints: dataPoints
            }]
        });
        
        function addData(data) {
            for (var i = 0; i < data.length; i++) {
                dataPoints.push({
                    x: new Date(data[i].tanggal_pakai),
                    y: data[i].status
                });
            }
            chart.render();
        
        }
        
        $.getJSON("http://127.0.0.1:8000/datariwayat", addData);
        
        }
</script>
</body>

</html>

