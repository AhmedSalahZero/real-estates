<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        لوحه التحكم |
        @yield('title')
    </title>
    <!-- Tell the browser to be responsive to screen width -->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
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
    @yield('header')

</head>

<body class="hold-transition sidebar-mini layout-fixed"  >
<!-- Navbar -->
<div class="wrapper" >
    <nav class="main-header navbar navbar-expand navbar-white navbar-light " style="direction: rtl" >
        <!-- Left navbar links -->

        <ul class="navbar-nav" >

            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{Route('index')}}" class="nav-link">الصفحه الرئيسيه </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block " >
                <a href="{{Route('contact-us.index')}}" class="nav-link">تواصل معنا</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">
                        {{getOnly3UnreadMessages()->count()}}
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                    @foreach( getOnly3UnreadMessages() as $unreadMessage)
                        <a href="{{url('adminPanel/contact')}}" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{asset('admin/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        {{$unreadMessage->name}}
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">{{Str::limit($unreadMessage->message,20)}}</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                    @endforeach
                    <a href="{{url('adminPanel/contact')}}" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->


            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">{{countUnreadMessages() + \App\Estate::where('estate_status',0)->count()}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">
                        @if ((countUnreadMessages() + \App\Estate::where('estate_status',0)->count()) == 0)
                            لا توجد اشعارات
                           @elseif((countUnreadMessages() + \App\Estate::where('estate_status',0)->count()) == 1)
                    اشعار واحد
                    @else
                            {{countUnreadMessages() + \App\Estate::where('estate_status',0)->count() }}
                        اشعارات

                            @endif
                    </span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">

                        @if(countUnreadMessages()==0)
                            لا توجد رسائل جديده
                        @elseif(countUnreadMessages()==1)
                            رساله جديده
                        @elseif(countUnreadMessages()==2)
                            توجد رسالتان
                        @else
                            رسائل جديده
                            {{countUnreadMessages()}}
                        @endif
                            <i class="fas fa-envelope mr-2" style="margin-right: 3px"></i>
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>

                    <a href="{{Route('admin.estates.non')}}" class="dropdown-item">
                        @if(\App\Estate::where('estate_status',0)->count()==0)
                            لا توجد عقارات غير مفعله
                        @else

                                {{\App\Estate::where('estate_status',0)->count()}}
                                عقارات غير مفعله

                            @endif

                        <i class="fas fa-window-close" style="margin-right: 3px"></i>
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>


        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>




        <!-- Right navbar links -->



    </nav>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" >
        <!-- Brand Logo -->
        <a href="{{route('panel.index')}}" class="brand-link">
            <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">لوحه التحكم </span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{Auth()->user()->name}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2" >
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                التحكم في الاعضاء
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{Route('users.index')}}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>عرض جميع الاعضاء </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{Route('users.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>اضافه عضو جديد </p>
                                </a>
                            </li>


                        </ul>
                    </li>
                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-address-book"></i>
                            <p>
                                اعدادات الموقع
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{Route('setting.index')}}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> اعدادات رئيسيه </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{Route('setting.index')}}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> اعدادات ثانويه </p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-address-book"></i>
                            <p>
                                التحكم في العقارات
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{Route('estates.index')}}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> عرض جميع العقارات </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{Route('estates.create')}}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> اضافه عقار جديد </p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-address-book"></i>
                            <p>
                                الرسائل و الاقترحات
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{Route('contact.index')}}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> عرض الرسائل </p>
                                </a>
                            </li>


                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrumb')
                            {{--                            <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسيه</a></li>--}}
                            {{--                            <li class="breadcrumb-item active">لوحه التحكم</li>--}}
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        @yield('content')
    </div>


    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.0.2
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
</div>


<!-- jQuery -->
<script src="{{asset('admin/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('admin/admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- JQVMap -->
<script src="{{asset('admin/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->

<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('admin/plugins/sparklines/sparkline.js')}}"></script>
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
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('dist/js/demo.js')}}"></script>

<script src="{{asset('admin/admin/dist/js/demo.js')}}"></script>
<script src="{{asset('admin/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('admin/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('admin/plugins/jquery-mapael/jquery.mapael.min.js')}}}"></script>
<script src="{{asset('admin/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>

<!-- PAGE SCRIPTS -->
<script src="{{asset('admin/dist/js/pages/dashboard2.js')}}"></script>

@yield('footer')

</body>

</html>
