@extends('admin.layout')
@section('title')
    الرئيسيه
@endsection

@section('header')
    <style>
        .content-header {
            padding: 6px .5rem;
        }
        .products-list .product-info {
            margin-left: 60px;
            margin-bottom: 9px;
        }


    </style>

    @endsection
@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">

                        <div class="inner">
                            <div class="icon">
                                <i class="ion ion-home"></i>
                            </div>
                                    <h3>{{App\Estate::where('estate_status' , 1)->count() }}</h3>
                                <p> عقارات مفعله</p>
                        </div>

                        <a href="{{Route('showAllActive')}}" class="small-box-footer">عرض الجميع<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3> {{App\Estate::where('estate_status' , 0)->count() }} </h3>
                            <p>عقارات غير مفعله</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-time"></i>
                        </div>
                        <a href="{{Route('showAllNonActive')}}" class="small-box-footer">عرض الجميع <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                   <h3> {{App\Contact::all()->count() }} </h3>

                            <p>رسائل </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-mail"></i>
                        </div>
                        <a href="{{url('adminPanel/contact')}}" class="small-box-footer">جميع الرسائل <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{\app\User::all()->count()}}</h3>
                            <p>اعضاء</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-person"></i>
                        </div>
                        <a href="{{url('adminPanel/users')}}" class="small-box-footer">عرض الجميع <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">

                <div class="col-md-6">

                    <!-- /.card -->
                    <div class="row">

                            <!-- USERS LIST -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">احدث الاعضاء</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <ul class="users-list clearfix">
                                       @foreach($latestUsers as $latestUser)
                                            <li>
                                                <img src="{{asset('admin/dist/img/user1-128x128.jpg')}}" alt="{{$latestUser->name}}">
                                                <a class="users-list-name" href="#">
                                                    {{$latestUser->name}}
                                                </a>
                                                <span class="users-list-date">Today</span>
                                            </li>

                                            @endforeach
                                    </ul>
                                    <!-- /.users-list -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <a href="{{url('adminPanel/users')}}">عرض جميع الاعضاء</a>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!--/.card -->
                        <!-- /.col -->
                    </div>

                </div>
                <div class="col-md-6">

                    <!-- PRODUCT LIST -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">عقارات مضافه حديثا</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">

@foreach($latestEstates as $latestEstate)
                                <li class="item" style="direction: rtl">
                                    <div class="product-img">
                                        <img src="{{asset($latestEstate->estate_image)}}" alt="{{asset($latestEstate->estate_name)}}" class="img-size-50">
                                    </div>
                                    <div class="product-info">
                                        <span href="javascript:void(0)" class="product-title">
                                            {{$latestEstate->estate_name}}
                                            <span class="badge badge-warning float-right">


                                                 {{$latestEstate->estate_price}}
جنيه
                                                <br>
                                            </span></span>
                                        <span class="product-description">
                     {{Str::limit($latestEstate->estate_large_desc,50)}}

                      </span>
                                    </div>
                                </li>
@endforeach
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <a href="{{url('adminPanel/estates')}}" class="uppercase">عرض جميع العقارات</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>












            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
@section('footer')

    @endsection
