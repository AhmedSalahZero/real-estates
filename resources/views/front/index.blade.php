@extends('layouts.app')
@section('title')
  كل العقارات
@endsection
@section('header')
    {!! Html::style('css/allEstatesPage.css') !!}
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

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



    <div class="container">
        <div class="row profile">

            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسيه</a></li>
                      @if(!isset($searched))
                            @if($active == 8)
                                <li class="breadcrumb-item "><span>عقارات للايجار</span></li>
                            @elseif($active==4)
                                <li class="breadcrumb-item "><span>كل العقارات</span></li>
                            @elseif($active == 9)
                                <li class="breadcrumb-item "><span>عقارات تمليك</span></li>
                            @elseif($active == 10)
                                <li class="breadcrumb-item "><span>شقق</span></li>
                            @elseif($active == 11)
                                <li class="breadcrumb-item "><span>فلل</span></li>
                            @elseif($active == 12)
                                <li class="breadcrumb-item "><span>شاليهات</span></li>
                            @elseif($active == 2)
                                <li class="breadcrumb-item active"><span>عقارتي المفضله </span></li>
                            @elseif($active == 3)
                                <li class="breadcrumb-item active"><span>عقارتي الغير مفعله </span></li>
                            @endif

                          @endif
                        @if( isset($searched) && $searched != null)
                            @foreach($searched as $key=>$val)
                                <li> <a href="{{url('/search?'.$key.'='.$val)}}">

                                    {{getValue()[$key]}} =>
                                    @if($key == "estate_type")
                                        {{getTheType()[$val]}}
                                        @elseif($key=="estate_rent")
                                        {{getRent()[$val]}}
                                    @elseif($key=="estate_location")
                                        {{getLocations()[$val]}}
                                        @else
                                        {{$val}}
                                    @endif
                                        </a>
                                </li>
                            @endforeach
                            @endif
                    </ol>
                </nav>

                <div class="profile-content">
                    @if(count($estates)>0)
                        @foreach($estates as$key=>$estate)
                            @if($key%3==0 && $key!=0)
                                <div class="clearfix"></div>
                            @endif
                            <div class="col-md-4 pull-right" >
                                <div class="productbox">
                                    <img src="{{asset($estate->estate_image)}}" class="img-responsive" style="width: 100% ; height: 100px" >
                                    <div class="producttitle text-center">{{$estate->estate_name}}</div>
                                    <p class="text-center dist">{{Str::limit($estate->estate_large_desc,30)}}</p>

                                    <span class="pull-right" style="max-width: 92px">
                                         المساحه:{{$estate->estate_area }}
                                            </span>
                                    <span class="pull-left" style="max-width: 93px">
                                                نوع العمليه: {{getRent()[$estate->estate_rent]}}
                                            </span>
                                    <span class="pull-right" style="max-width: 93px">
                                                نوع العقار : {{getTheType()[$estate->estate_type]}}
                                            </span>
                                    <br>

                                    <span class="pull-left">
                                                الموقع : {{getLocations()[$estate->estate_location]}}
                                            </span>
                                    <br>

                                            @if($estate->estate_status==1)
                                        <div class="productprice"> <div class="pull-left">
                                            <a href="{{Route('single.show',$estate->id)}}" class="btn btn-primary btm-sm" role="button">التفاصيل<span class=""></span></a></div><div class="pricetext">{{$estate->estate_price}} جنيه</div></div>
                                    @else

                                        <br>
                                        <div class="productprice"> <div class="pull-left">
                                                <br>
                                            <span class="btn btn-danger btm-sm" role="button">في انتظار التفعيل<span class=""></span></span></div><div class="pricetext">{{$estate->estate_price}} جنيه</div></div><a href="{{Route('EditEstate',$estate->id)}}" class="btn btn-warning btn-sm" > تعديل القعار </a>

                            @endif
                </div>
            </div>
            @endforeach
            @else
                <div class="alert alert-danger text-center">
                    <h2> لا يوجد عقارات حاليا</h2>
                </div>

            @endif
        </div>

        {{$estates->appends(Request::except('page'))->render()}}

            </div>

            @include('front.SearchAndEstateOpt')

        </div>




    </div>
    <br>
    <br>
@endsection

@section('footer')
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

@endsection
