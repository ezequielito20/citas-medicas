<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <!-- boostrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- FullCalendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script src="{{ asset('fullcalendar/es.global.js') }}"></script>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ asset('/index') }}" class="nav-link">Reserva de Citas Médicas</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">


                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ asset('index3.html') }}" class="brand-link">
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Citas Médicas</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->roles->first()->name }}</a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @can('admin.users.index')
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas bi bi-people-fill"></i>
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('users') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Usuarios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @can('admin.secretaries.index')
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas bi bi-person-check-fill"></i>
                                <p>
                                    Secretarias
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('secretaries') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Secretarias</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @can('admin.patients.index')
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas bi bi-person-plus-fill"></i>
                                <p>
                                    Pacientes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('patients') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Pacientes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @can('admin.offices.index')
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas bi bi-house-check-fill"></i>
                                <p>
                                    Consultorios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('offices') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Consultorios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @can('admin.doctors.index')
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas bi bi-person-hearts"></i>
                                <p>
                                    Doctores
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('doctors') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Doctores</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('doctors/reports') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reportes </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @can('admin.hours.index')
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas bi bi-calendar3"></i>
                                <p>
                                    Horarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('hours') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Horarios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @can('admin.hours.index')
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas bi bi-wrench-adjustable"></i>
                                <p>
                                    Configuraciones
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('configurations') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Configuraciones</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan

                        @can('admin.users.index')
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas bi bi-calendar-check"></i>
                                <p>
                                    Reservas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('reservations/reports') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Reservas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan

                        @can('admin.historial.index')
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas bi bi-clipboard2-pulse"></i>
                                <p>
                                    Historial Clínico
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('historial') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Historiales</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        <li class="nav-item">
                            <a href="{{ url('logout') }}" class="nav-link">
                                <i class="nav-icon fas bi bi-box-arrow-right"></i>
                                <p>
                                    Cerrar Sesión
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @if (($message = Session::get('message')) && ($icons = Session::get('icons')))
            <script>
                Swal.fire({
                    position: "center",
                    icon: "{{ $icons }}",
                    title: "{{ $message }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
        @endif

        <div class="content-wrapper">
            <div class="container">
                @yield('content')
            </div>
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2024-actualidad <a href="#">scriping</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->


    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
