@extends('layouts.app')
@section('title')
    كل العقارات
@endsection
@section('header')
    <style>

        .dist{
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .item{
            margin-bottom: 10px;
        }
        .xx{
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.428571429;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            margin-left: 770px;

        }

    </style>

    {!! Html::style('css/allEstatesPage.css') !!}
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link href="{{asset('select/css/select2.min.css')}}" rel="stylesheet" />
    {{--    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">--}}

@endsection
@section('content')
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


    <div class="container">
        <div class="row profile">
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسيه</a></li>
                       @if($active == 1)
                            <li class="breadcrumb-item active"><span>تعديل بيانات عضو </span></li>
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
                    <div class="card card-default">
                        @include('partial.session')
                        @include('partial.validation')
                        <div class="card-header text-right" >
                            <hr>
                            <h3 style="" class="text-center">
                                تعديل بيانات عضو
                            </h3>
                            <hr>
                        </div>

                        <div class="card-body" style="margin-right: 380px ; direction: rtl" >

                            <form method="post" action="{{route('updateUser') }}" >
                                @csrf
                                @method('PUT')
                                <div class="form-group row">

                                    <div class="col-md-6">
                                        <input id="name" type="text" placeholder="الاسم " style="width: 600px" class="xx form-control " name="name" value="{{Auth::user()->name}}"  autocomplete="name" autofocus>


                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <input id="email"  style="width: 600px"  type="email" placeholder="البريد الالكتروني " class="xx form-control " name="email" value="{{Auth::user()->email}}"  autocomplete="email">

                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-3 ">
                                        <button type="submit" class="btn btn-success " style="width: 200px ; margin-right: -460px">
                                            تعديل
                                        </button>
                                    </div>
                                </div>
                            </form>







                            <div class="card card-default">
                                <div class="card-header text-right" style="margin-right: -405px" >
                                    <hr>
                                    <h3 style="" class="text-center">
                                       تعديل كلمه المرور
                                    </h3>
                                    <hr>
                                </div>

                                <div class="card-body" style="margin-right: 380px ; direction: rtl" >
                                    <form method="POST" action="{{ route('updatePass')}}" >
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <input  style="width: 600px"  placeholder=" كلمه المرور القديمه " type="password" class="xx form-control" name="oldPass" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <input   style="width: 600px"  placeholder=" كلمه المرور الجديده" type="password" class="xx form-control" name="newPass" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-3 ">
                                                <button type="submit" class="btn btn-success " style="width: 200px ; margin-right: -542px">
                                                   تعديل كلمه المرور
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>








                        </div>
                    </div>



                </div>

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
