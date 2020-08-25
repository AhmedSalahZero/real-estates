

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

@endsection
@section('title')
    {{isset($estate) ? "تعديل عقار" :"اضافه عقار جديد"}}

@endsection
@section('content')
    <div class="card card-default" >
        <div class="card-header" style="direction: rtl">
                <ol class="breadcrumb float-sm-right">
                    @yield('breadcrumb')
                    <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active">
                        {{isset($estate) ? "تعديل عقار" :"اضافه عقار جديد"}}

                    </li>
                </ol>
<br> <br> <br>

            <div class="card-body" style=" direction: rtl" >
            <form method="POST" enctype="multipart/form-data" action="{{isset($estate) ? route('user.estate.update' , $estate->id):route('user.store') }}" >

                @if(isset($estate) )
                    @method('PUT')
                @endif
                @csrf
                    @if(isset($estate))
                        <img src="{{asset($estate->estate_image)}}" style="width: 600px ; height: 300px;margin-left: 438px" alt="{{$estate->estate_name}}" >
                   <br> <br> <br>
                    @endif

                    <div class="form-group row">
                        <div class="col-md-1">
                            <label for="name"> اسم العقار </label>
                        </div>
                        <div  style="margin-right: 250px ;">
                            <input id="name" type="text" style="width: 600px" class="form-control @error('name') is-invalid @enderror" name="name" value="{{isset($estate) ? $estate->estate_name :old('name') }}"  autocomplete="name" >
                            @if($errors->has('name'))
                                <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{$errors->first('name') }}</strong>
                                    </span>
                            @endif

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <label for="price" >سعر العقار</label>
                        </div>
                        <div  style="margin-right: 250px ;">
                            <input id="price"  style="width: 600px"  type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ isset($estate) ? $estate->estate_price :old('price')}}"  autocomplete="price">
                            @if($errors->has('price'))
                                <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <label for="area" >مساحه العقار</label>
                        </div>
                        <div style="margin-right: 250px ;">
                            <input id="area" type="text" style="width: 600px" class="form-control @error('area') is-invalid @enderror" name="area" value="{{isset($estate) ? $estate->estate_area :old('area') }}"  autocomplete="area" >
                            @if($errors->has('area'))
                                <span class="invalid-feedback text-right" role="alert" >
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <label for="room" >عدد الغرف</label>
                        </div>
                        <div style="margin-right: 250px ;">
                            <input id="room" type="number" style="width: 600px" class="form-control @error('room') is-invalid @enderror" name="room" value="{{isset($estate) ? $estate->estate_rooms :old('room') }}"  autocomplete="room" >
                            @if($errors->has('room'))
                                <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{$errors->first('room') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-1">
                            <label for="type" >نوع العقار</label>
                        </div>
                        <div style="margin-right: 250px ;">
                            <select style="width: 600px" class="form-control" name="type" id="type">
                                <option value="0" @if(isset($estate) && $estate->estate_type == 0 )selected @endif > شقه </option>
                                <option value="1" @if(isset($estate) && $estate->estate_type == 1 )selected @endif> فيلا </option>
                                <option value="2" @if(isset($estate) && $estate->estate_rent == 2 )selected @endif>  شاليه </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <label for="rent" >نوع العمليه</label>
                        </div>
                        <div style="margin-right: 250px ;">
                            <select style="width: 600px" class="form-control" name="rent" id="rent">
                                <option value="0" @if(isset($estate) && $estate->estate_rent == 0 ) selected @endif> ايجار </option>
                                <option value="1" @if(isset($estate) && $estate->estate_rent == 1 ) selected @endif> تمليك </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <label for="longitude" >خط الطول</label>
                        </div>
                        <div  style="margin-right: 250px ;">
                            <input id="longitude"  style="width: 600px"  type="number" class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{isset($estate) ? $estate->estate_longitude : old('longitude')}}"  autocomplete="longitude">
                            @if($errors->has('longitude'))
                                <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{$errors->first('longitude') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <label for="latitude" >دائره العرض</label>
                        </div>
                        <div  style="margin-right: 250px ;">
                            <input id="latitude"  style="width: 600px"  type="number" class="form-control @error('latitude') is-invalid @enderror " name="latitude" value="{{isset($estate) ? $estate->estate_latitude : old('latitude')}}"  autocomplete="latitude">
                            @if($errors->has('latitude'))
                                <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{$errors->first('latitude') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <label for="image" >صوره للعقار</label>
                        </div>
                        <div style="margin-right: 250px  ">

                            <input  style="width: 600px" type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" >
                            @if($errors->has('image'))
                                <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                            @endif


                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <label for="location">موقع العقار </label>
                        </div>
                        <div  style="margin-right: 250px ;">

                            <select name="location" id="location" class="form-control ourSelect " style="width: 600px  "  >

                                @foreach(getLocations() as $key=>$val )
                                    <option value="{{$key}} @if(isset($estate) && $estate->estate_location ==$key ) selected @endif ">{{$val}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('location'))
                                <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{$errors->first('location') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-1">
                            <label for="keywords"> الكلمات الدلائليه </label>
                        </div>
                        <div  style="margin-right: 250px ;">
                            <input id="keywords" type="text" style="width: 600px" class="form-control @error('keywords') is-invalid @enderror " name="keywords" value="{{isset($estate) ? $estate->estate_keywords : old('keywords') }}"  autocomplete="keywords" >
                            @if($errors->has('keywords'))
                                <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{$errors->first('keywords') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-md-1">
                            <label for="large_desc" >وصف مطول للعقار </label>
                        </div>
                        <div  style="margin-right: 250px ;">
                            <textarea id="large_desc" type="text" cols="10" rows="10" style="width: 600px" class="form-control  @error('large_desc') is-invalid @enderror" name="large_desc"  > {{isset($estate) ? $estate->estate_large_desc :old('large_desc') }} </textarea>
                            @if($errors->has('large_desc'))
                                <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{$errors->first('large_desc') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-7">
                            <button type="submit" class="btn btn-outline-dark " style="width: 200px">
                                {{isset($estate) ? "تعديل العقار": "اضافه العقار"}}
                            </button>


                        </div>

                    </div>

            </form>

        </div>
    </div>
    </div>




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
