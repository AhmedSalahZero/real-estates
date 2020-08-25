@extends('layouts.app')


@section('header')
   <style>
       .banner{
          background: url({{asset(getSetting('mainBackGround'))}}) no-repeat center;
           min-height: 500px;
           width: 100%;
           -webkit-background-size: 100%;
           -moz-background-size: 100%;
           -o-background-size: 100%;
           background-size: 100%;
           -webkit-background-size: cover;
           -moz-background-size: cover;
           -o-background-size: cover;
           background-size: cover;
           padding-bottom: 100px;
       }

   </style>
   <link rel="stylesheet" href="{{asset('dist/css/styles.css')}}" type="text/css" media="screen" title="no title" charset="utf-8">
   <link rel="stylesheet" href="{{asset('dist/css/quick-view.css')}}" type="text/css" media="screen" title="no title" charset="utf-8">

   <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>


    @endsection
@section('content')
    <div class="banner text-center" >
        <div class="container">
            <div class="banner-info">

                <h1 style="color: #000000">
                    اهلا بك في
                    {{getSetting('siteName')}}
                </h1>
                <p>

                    {!! Form::open(['url'=>'/search' ,'method'=>'GET']) !!}

                <div class="row">
                        <div class="col-lg-3">
                            {{Form::text('estate_price_from',null,['class'=>'form-control' , 'placeholder'=>'سعر العقار من'])}}
                        </div>
                        <div class="col-lg-3">
                            {{Form::text('estate_price_to',null,['class'=>'form-control' , 'placeholder'=>' سعر العقار الي'])}}
                        </div>
                        <div class="col-lg-3">
                            {{Form::select('estate_location',getLocations(),null,['class'=>'form-control ourSelect' , 'placeholder'=>'موقع العقار'])}}
                        </div>
                        <div class="col-lg-3">
                            {{Form::select('estate_rooms',roomNumber(),null,['class'=>'form-control' , 'placeholder'=>'عدد الغرف'])}}
                        </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        {!! Form::submit('ابحث',['class'=>'btn' ,'style'=>'width:100%']) !!}
                    </div>
                        <div class="col-lg-3">
                            {{Form::select('estate_type',getTheType(),null,['class'=>'form-control' , 'placeholder'=>'نوع العقار'])}}
                        </div>
                        <div class="col-lg-3">
                            {{Form::select('estate_rent',getRent(),null,['class'=>'form-control' , 'placeholder'=>'نوع العمليه'])}}
                        </div>
                        <div class="col-lg-3">
                            {{Form::text('estate_area',null,['class'=>'form-control' , 'placeholder'=>'المساحه'])}}
                        </div>
                </div>
                        {!! Form::close() !!}
                </p>
                <a class="banner_btn" href="{{route('user.add')}}"> أضف عقارك </a> </div>

        </div>
    </div>

    <div class="container js-quick-view">
        <ul class="products">
            @foreach(\App\Estate::where('estate_status',1)->get() as $product)
            <li class="quick-view-item" data-product-id="product-seven">
                <img style="margin-bottom: 20px" src="{{asset($product->estate_image)}}" alt="Product .{{$product->id}}" class="js-product-image" height="350" width="350">
                <div class="quick-view">
                    <div class="quick-view-button js-quick-view-trigger">+ Quick view</div>
                </div>
            </li>

            @endforeach
        </ul>
        <div class="quick-view-modal js-quick-view-modal">
            <div class="quick-view-overlay js-quick-view-overlay"></div>
            <div class="quick-view-canvas animation">
                <div class="quick-view-canvas-inner"></div>
                <div class="quick-view-close js-quick-view-close"></div>
            </div>
        </div>
    </div>


        @endsection

@section('footer')
            <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
            <script src="{{asset('dist/js/quickView.js')}}"></script>
            <script src="{{asset('dist/js/main.js')}}"></script>
    @endsection
