<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> {{env('APP_NAME')}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('theme/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('theme/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('theme/css/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('theme/css/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('theme/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('theme/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('theme/css/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('theme/css/summernote-bs4.min.css')}}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @if(Auth::user()->role)
    @include('layouts.navbar')

    @else
    @include('layouts.user-navbar')
    @endif
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('theme/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
        </div>
        @if(Auth::user()->role)
        @include('layouts.sidebar')
        @else
        @include('layouts.user-sidebar')
        @endif
        <div class="content-wrapper">
            <section class="content">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <h2>@yield('title')</h2>

                        </div>

                    </div>
                </div>
                <div class="container-fluid">
                    @if(\Session::get('success'))
                    <div class="alert alert-success fade show" role="alert">
                        <div class="alert-body">
                            {{ \Session::get('success') }}
                        </div>
                    </div>
                    @endif
                    {{ \Session::forget('success') }}
                    @if(\Session::get('error'))
                    <div class="alert alert-danger fade show" role="alert">
                        <div class="alert-body">
                            {{ \Session::get('error') }}
                        </div>
                    </div>
                    @endif
                    @yield('content')
                </div>
            </section>
        </div>
        <!-- Content Wrapper. Contains page content -->
        <!-- <div class="content-wrapper">
            Content Header (Page header)
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div> /.col
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/admin/logout">Logout</a></li>
                            </ol>
                        </div>  
                    </div> 
                </div>
            </div>
            /.content-header

        </div> -->
        <!-- /.content-wrapper  -->
        @include('layouts.footer')



    </div>
    <!-- ./wrapper  -->

    <!-- jQuery  -->

    <script src="{{asset('theme/js/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4  -->
    <script src="{{asset('theme/js/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip  -->

    <!-- Bootstrap 4  -->
    <script src="{{asset('theme/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS  -->
    <script src="{{asset('theme/js/Chart.min.js')}}"></script>
    <!-- Sparkline  -->
    <script src="{{asset('theme/js/sparkline.js')}}"></script>
    <!-- jQuery Knob Chart  -->
    <script src="{{asset('theme/js/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker  -->
    <script src="{{asset('theme/js/moment.min.js')}}"></script>
    <script src="{{asset('theme/js/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4  -->
    <script src="{{asset('theme/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote  -->
    <script src="{{asset('theme/js/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars  -->
    <script src="{{asset('theme/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App  -->
    <script src="{{asset('theme/js/adminlte.js')}}"></script>
    <script>
        $(document).ready(function() {
            $(".alert").delay(5000).slideUp(300);
        });
    </script>
    @yield('script')
</body>

</html>