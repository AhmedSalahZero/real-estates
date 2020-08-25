@extends('layouts.app')
@section('header')
    <link href="{{asset('select/css/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('admin/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


    <style>
        label{

        }
    </style>
@endsection
@section('title')
    اضافه عقار جديد

@endsection

@section('content')

    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسيه</a></li>
        <li class="breadcrumb-item active">اضافه عقار جديد</li>
    </ol>


<br> <br> <br>
    <div class="text-center alert alert-dismissible">
        <h3> تم اضافه العقار بنجاح  </h3>


    </div>
 <br><br> <br> <br><br> <br> <br><br> <br> <br> <br> <br> <br> <br><br>



    @endsection

    @section('footer')

        <!-- jQuery -->
            <script src="{{asset("admin/plugins/jquery/jquery.min.js")}}"></script>
            <!-- jQuery UI 1.11.4 -->
            <script src="{{asset('admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
            <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
            <script>
                $.widget.bridge('uibutton', $.ui.button)
            </script>
            <!-- Bootstrap 4 -->
            <script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
            <!-- ChartJS -->
            <script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
            <!-- Sparkline -->
            <script src="{{asset('admin/plugins/sparklines/sparkline.js')}}"></script>
            <!-- JQVMap -->
            <script src="{{asset('admin/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
            <script src="{{asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
            <!-- jQuery Knob Chart -->
            <script src="{{asset('admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
            <!-- daterangepicker -->
            <script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
            <script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
            <!-- Tempusdominus Bootstrap 4 -->
            <script src="{{asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
            <!-- Summernote -->
            <script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
            <!-- overlayScrollbars -->
            <script src="{{asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
            <!-- AdminLTE App -->
            <script src="{{asset('admin/dist/js/adminlte.js')}}"></script>
            <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
            <script src="{{asset('admin/dist/js/pages/dashboard.js')}}"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="{{asset('admin/dist/js/demo.js')}}"></script>

            <script src="{{asset('select/js/select2.min.js')}}"></script>
            <script type="text/javascript">

                $('.ourSelect').select2({
                    dir: "rtl"
                });

            </script>
@endsection
