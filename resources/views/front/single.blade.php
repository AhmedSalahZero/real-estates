@extends('layouts.app')
@section('title')
    {{$estate->estate_name}}
@endsection
@section('header')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e3ed47ce21d488e"></script>
    {!! Html::style('css/allEstatesPage.css') !!}
    <link href="{{asset('select/css/select2.min.css')}}" rel="stylesheet" />
    <style>

        .dist{
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .item{
            margin-bottom: 10px;
        }

    </style>
    {{--    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">--}}

@endsection
@section('content')
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <!--
    User Profile Sidebar by @keenthemes
    A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
    Licensed under MIT
    -->

    <div class="container">
        <div class="row profile">
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسيه</a></li>
                        <li class="breadcrumb-item"><a href="{{Route('getEstates.index')}}">كل العقارات</a></li>
                        <li class="breadcrumb-item"><a href="{{Route('single.show',$estate->id)}}">{{$estate->estate_name}}</a></li>
                    </ol>
                </nav>

                <div class="profile-content">

                    <h2 class="text-center">{{$estate->estate_name}}</h2>
                    <hr>
                    <div class="btn-group" role="group">


                      <a class="btn btn-default pull-right" style="color: inherit" href="{{url('search?'.'estate_price='.$estate->estate_price)}}">
                             السعر : {{$estate->estate_price}}
                      </a>

                      <a class="btn btn-default pull-right" style="color: inherit" href="{{url('search?'.'estate_area='.$estate->estate_area)}}">
                             المساحه : {{$estate->estate_area}}
                      </a>

                    <a class="btn btn-default pull-right" style="color: inherit" href="{{url('search?'.'estate_location='.$estate->estate_location)}}">
                         المنطقه : {{getLocations()[$estate->estate_location]}}
                    </a>

                    <a class="btn btn-default pull-right" style="color: inherit" href="{{url('search?'.'estate_rooms='.$estate->estate_rooms)}}">
                         عدد الغرف : {{$estate->estate_rooms}}
                    </a>


                    <a class="btn btn-default pull-right" style="color: inherit" href="{{url('search?'.'estate_rent='.$estate->estate_rent)}}">
                         نوع العمليه : {{getRent()[$estate->estate_rent]}}
                    </a>
                    <a class="btn btn-default pull-right" style="color: inherit" href="{{url('search?'.'estate_type='.$estate->estate_type)}}">
                          نوع العقار : {{getTheType()[$estate->estate_type]}}
                    </a>


                    </div>
                    <hr>
                    <br>
                    <img src="{{asset($estate->estate_image)}}" class="img-responsive">
                    <p class="text-center">
                        <span >
                            {!! $estate->estate_large_desc !!}
                        </span>
                    </p>
                </div>
                <br>
                <div class="addthis_inline_share_toolbox"></div>
                <br>
<h3 class="text-center"> عقارات ذات صله </h3>
                <hr>
                <div class="profile-content">
                    {{--                with the same rent (get only 3 )--}}
                    @foreach($with_same_rent as$key=>$estate)
                        @if($key%3==0 && $key!=0)
                            <div class="clearfix"></div>
                        @endif
                        <div class="col-md-4 pull-right" >
                            <div class="productbox">
                                <img src="{{asset($estate->estate_image)}}" class="img-responsive" style="width: 100% ; height: 100px" >
                                <div class="producttitle text-center">{{$estate->estate_name}}</div>
                                <p class="text-center dist">{{Str::limit($estate->estate_large_desc,30)}}</p>

                                <span class="pull-right">
                                                المساحه : {{$estate->estate_area}}
                                            </span>
                                <span class="pull-left">
                                                نوع العمليه : {{getRent()[$estate->estate_rent]}}
                                            </span>

                                <span class="pull-right">
                                                نوع العقار : {{getTheType()[$estate->estate_type]}}
                                            </span>
                                <span class="pull-left">
                                                الموقع : {{getLocations()[$estate->estate_location]}}
                                            </span>

                                <div class="productprice"><div class="pull-left"><a href="{{Route('single.show',$estate->id)}}" class="btn btn-primary btm-sm" role="button">التفاصيل<span class="glyphicon glyphicon-shopping-cart"></span></a></div><div class="pricetext">{{$estate->estate_price}} جنيه</div></div>
                            </div>
                        </div>


                    @endforeach
                        {{--                with the same type (only 3 )--}}
                    @if(count($with_same_rent)==3)
                        <div class="clearfix"></div>
                        @endif
                    @foreach($with_same_type as$key=>$estate)
                            @if($key%3==0 && $key!=0)
                                <div class="clearfix"></div>
                            @endif
                            <div class="col-md-4 pull-right" >
                                <div class="productbox">
                                    <img src="{{asset($estate->estate_image)}}" class="img-responsive" style="width: 100% ; height: 100px" >
                                    <div class="producttitle text-center">{{$estate->estate_name}}</div>
                                    <p class="text-center dist">{{Str::limit($estate->estate_large_desc,30)}}</p>

                                    <span class="pull-right">
                                                المساحه : {{$estate->estate_area}}
                                            </span>
                                    <span class="pull-left">
                                                نوع العمليه : {{getRent()[$estate->estate_rent]}}
                                            </span>
                                    <span class="pull-right">
                                                نوع العقار : {{getTheType()[$estate->estate_type]}}
                                            </span>
                                    <span class="pull-left">
                                                الموقع : {{getLocations()[$estate->estate_location]}}
                                            </span>
                                    <div class="productprice"><div class="pull-left"><a href="{{Route('single.show',$estate->id)}}" class="btn btn-primary btm-sm" role="button">التفاصيل<span class="glyphicon glyphicon-shopping-cart"></span></a></div><div class="pricetext">{{$estate->estate_price}} جنيه</div></div>
                                </div>
                            </div>
                        @endforeach
                </div>
                <br>
            </div>
            @include('front.SearchAndEstateOpt')
        </div>
    </div>
    <br>
    <br>
@endsection
@section('footer')
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="{{asset('select/js/select2.min.js')}}"></script>
    <script type="text/javascript">

        $('.ourSelect').select2({
            dir: "rtl"
        });

    </script>


@endsection
