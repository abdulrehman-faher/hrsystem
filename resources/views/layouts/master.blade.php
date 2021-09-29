<!DOCTYPE html>

<html>



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>DHA HR | {{isset($title) ? $title : 'Dashboard'}}</title>

    <!-- Tell the browser to be responsive to screen width -->

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Ionicons -->

    <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">

    <!-- Tempusdominus Bbootstrap 4 -->

    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <!-- iCheck -->

    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- JQVMap -->

    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">

    <!-- Theme style -->

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <!-- overlayScrollbars -->

    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- Daterange picker -->

    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">

    <!-- summernote -->

    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">

    <!-- Google Font: Source Sans Pro -->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />



    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" /> -->

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" />

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <!-- Styles -->

    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />

    @yield('styles')

</head>



<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">



        <!-- Navbar -->

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <!-- Left navbar links -->

            <ul class="navbar-nav">

                <li class="nav-item">

                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>

                </li>

                <li class="nav-item d-none d-sm-inline-block">

                    <a href="{{route('home')}}" class="nav-link">Home</a>

                </li>

            </ul>



            <!-- SEARCH FORM -->

            @include('layouts.searchform')



            <!-- Right navbar links -->

            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown">

                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                        {{ Auth::user()->name }} <span class="caret"></span>

                    </a>



                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); 
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>

                        <a class="dropdown-item" href="#">{{ __('Change Password') }}</a>

                    </div>

                </li>

            </ul>

        </nav>

        <!-- /.navbar -->



        <!-- Main Sidebar Container -->

        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Brand Logo -->

            <a href="index3.html" class="brand-link">

                <img src="{{ url('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">

                <span class="brand-text font-weight-light">DHA HR</span>

            </a>



            <!-- Sidebar -->

            <div class="sidebar">

                <!-- Sidebar user panel (optional) -->

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                    <div class="image">

                        <img src="{{ url('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">

                    </div>

                    <div class="info">

                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>

                    </div>

                </div>



                <!-- Sidebar Menu -->

                <nav class="mt-2">

                    <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">

                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                        <li class="nav-item">

                            <a href="{{route('home')}}" class="nav-link {{ Helper::activeClass($active, 'dashboard') }}">

                                <i class="nav-icon fas fa-tachometer-alt"></i>

                                <p>Dashboard</p>

                            </a>

                        </li>



                        <li class="nav-item has-treeview {{ Helper::activeClass($active, 'employee', 'menu-open') }}">

                            <a href="#" class="nav-link {{ Helper::activeClass($active, 'employee') }}">

                                <i class="nav-icon far fa-user"></i>

                                <p>

                                    Employees

                                    <i class="fas fa-angle-left right"></i>

                                </p>

                            </a>

                            <ul class="nav nav-treeview">

                                <li class="nav-item">

                                    <a href="{{ route('employees.create') }}" class="nav-link {{ Helper::activeClass($activeChild, 'employeeAddNew') }}">

                                        <i class="far fa-circle nav-icon"></i>

                                        <p>Add New <i class="fas fa-user-plus right"></i></p>

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a href="{{ route('employees.index') }}" class="nav-link  {{ Helper::activeClass($activeChild, 'employeeViewAll') }}">

                                        <i class="far fa-circle nav-icon"></i>

                                        <p>View All <i class="fas fa-eye right"></i></p>

                                    </a>

                                </li>

                            </ul>

                        </li>



                        <li class="nav-header">New Applications</li>

                        <li class="nav-item has-treeview {{ Helper::activeClass($active, 'application', 'menu-open') }}">

                            <a href="#" class="nav-link {{ Helper::activeClass($active, 'application') }}">

                                <i class="nav-icon far fa-book"></i>

                                <p>

                                    Applications

                                    <i class="fas fa-angle-left right"></i>

                                </p>

                            </a>

                            <ul class="nav nav-treeview">

                                <li class="nav-item">

                                    <a href="{{route('applications.create')}}" class="nav-link {{ Helper::activeClass($activeChild, 'applicationAddNew') }}">

                                        <i class="far fa-circle nav-icon"></i>

                                        <p>Add New <i class="fas fa-user-plus right"></i></p>

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a href="{{route('applications.index')}}" class="nav-link  {{ Helper::activeClass($activeChild, 'applicationViewAll') }}">

                                        <i class="far fa-circle nav-icon"></i>

                                        <p>View All <i class="fas fa-eye right"></i></p>

                                    </a>

                                </li>

                            </ul>

                        </li>



                        <li class="nav-item has-treeview {{ Helper::activeClass($active, 'interview', 'menu-open') }}">

                            <a href="#" class="nav-link {{ Helper::activeClass($active, 'interview') }}">

                                <i class="nav-icon fas fa-address-card"></i>

                                <p>

                                    Interviews

                                    <i class="fas fa-angle-left right"></i>

                                </p>

                            </a>

                            <ul class="nav nav-treeview">

                                <li class="nav-item">

                                    <a href="{{ route('interviews.create') }}" class="nav-link {{ Helper::activeClass($activeChild, 'interviewAddNew') }}">

                                        <i class="far fa-circle nav-icon"></i>

                                        <p>Add New <i class="fas fa-plus-square right"></i></p>

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a href="{{ route('interviews.index') }}" class="nav-link  {{ Helper::activeClass($activeChild, 'interviewViewAll') }}">

                                        <i class="far fa-circle nav-icon"></i>

                                        <p>View All <i class="fas fa-eye right"></i></p>

                                    </a>

                                </li>

                            </ul>

                        </li>



                        <li class="nav-item">

                            <a href="{{ route('interviews.showSelected') }}" class="nav-link {{ Helper::activeClass($active, 'successfulCandidates') }}">

                                <i class="nav-icon fas fa-th"></i>

                                <p id="successfulCandidatesP">Successful Candidates </p>

                            </a>

                        </li>



                        <li class="nav-header">Admin</li>

                        <li class="nav-item">

                            <a href="{{route('logs.index')}}" class="nav-link {{ Helper::activeClass($active, 'logs') }}">

                                <i class="nav-icon fas fa-history"></i>

                                <p>LOGS</p>

                            </a>

                        </li>

                        <li class="nav-item has-treeview {{ Helper::activeClass($active, 'user', 'menu-open') }}">

                            <a href="#" class="nav-link {{ Helper::activeClass($active, 'user') }}">

                                <i class="nav-icon fas fa-users"></i>

                                <p>

                                    Users

                                    <i class="fas fa-angle-left right"></i>

                                </p>

                            </a>

                            <ul class="nav nav-treeview">

                                <li class="nav-item">

                                    <a href="{{ route('register') }}" class="nav-link {{ Helper::activeClass($activeChild, 'userAddNew') }}">

                                        <i class="far fa-circle nav-icon"></i>

                                        <p>Add New <i class="fas fa-user-plus right"></i></p>

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a href="{{ route('users.index') }}" class="nav-link  {{ Helper::activeClass($activeChild, 'userViewAll') }}">

                                        <i class="far fa-circle nav-icon"></i>

                                        <p>View All <i class="fas fa-eye right"></i></p>

                                    </a>

                                </li>

                            </ul>

                        </li>

                        <li class="nav-item has-treeview {{ Helper::activeClass($active, 'reports', 'menu-open') }}">

                            <a href="#" class="nav-link {{ Helper::activeClass($active, 'reports') }}">

                                <i class="nav-icon fas fa-file"></i>

                                <p>

                                    Reports

                                    <i class="fas fa-angle-left right"></i>

                                </p>

                            </a>

                            <ul class="nav nav-treeview">

                                <li class="nav-item">

                                    <a href="{{ route('report.employee_strength') }}" class="nav-link {{ Helper::activeClass($activeChild, 'reportEmpStrength') }}">

                                        <i class="far fa-circle nav-icon"></i>

                                        <p>Employee Strngth <i class="fas fa-dumbbell right"></i></p>

                                    </a>

                                </li>

                            </ul>

                        </li>

                        <li class="nav-item">

                            <a href="#" class="nav-link {{ Helper::activeClass($active, 'loginHistory') }}">

                                <i class="nav-icon fas fa-hotel"></i>

                                <p>Login History</p>

                            </a>

                        </li>

                    </ul>

                </nav>

                <!-- /.sidebar-menu -->

            </div>

            <!-- /.sidebar -->

        </aside>



        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">

            <!-- Content Header (Page header) -->

            <div class="content-header">

                <div class="container-fluid">

                    <div class="row mb-2">

                        <div class="col-sm-6">

                            <h1 class="m-0 text-dark">{{isset($title) ? $title : 'Dashboard'}}</h1>

                        </div><!-- /.col -->

                        <div class="col-sm-6">

                            @yield('breadcrumb')

                        </div><!-- /.col -->

                    </div><!-- /.row -->

                </div><!-- /.container-fluid -->

            </div>

            <!-- /.content-header -->



            @yield('content')

        </div>

        <!-- /.content-wrapper -->

        <footer class="main-footer">

            <strong>Copyright &copy; 1990-{{date('Y')}} <a href="https://defenceclubs.com/">Defence Clubs</a>.</strong>

            All rights reserved.

            <div class="float-right d-none d-sm-inline-block">

                <b>DHA HR Version</b> 1.0.0

            </div>

        </footer>



        <!-- Control Sidebar -->

        <aside class="control-sidebar control-sidebar-dark">

            <!-- Control sidebar content goes here -->

        </aside>

        <!-- /.control-sidebar -->

    </div>

    <!-- ./wrapper -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script> -->

    <!-- <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script> -->
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('js/home.js') }}"></script>

    @yield('scripts')

    @if(Session::has('success'))
    <script>
        Command: toastr["success"]("{!! Session::get('success') !!}")
    </script>
    @endif

    @if(Session::has('error'))
    <script>
        Command: toastr["error"]("{!! Session::get('error') !!}");
        // toastr.options = {
        //     "closeButton": true,
        //     "progressBar": true,
        //     "preventDuplicates": false,
        // }
    </script>
    @endif

    @if(Session::has('info'))
    <script>
        Command: toastr["info"]("{!! Session::get('info') !!}")
    </script>
    @endif

</body>



</html>