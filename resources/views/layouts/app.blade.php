<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Another way -->

    {!! Html::style('css/flexslider.css') !!}
    <!-- Another way --> <!-- Request()->root بتجيبلك رابط الموقع  : result will be  Www.building.com -->

    <link href="{{(Request()->root().'/css/style.css')}}" rel="stylesheet" />

<style>
    .btn-danger{
        color: #fff;
        background-color: #d9534f;
        border-color: #d43f3a;
        max-height: 24px;
        max-width: 85px;
        padding: 3px 4px;
        margin-top: -40px;
    }
    .btn-primary{
        color: #fff;
        background-color: #428bca;
        border-color: #357ebd;
        padding: 4px 1px;
        min-width: 55px;

    }
    .btn-warning {
        color: #fff;
        background-color: #f0ad4e;
        border-color: #eea236;
        margin-right: 142px;
</style>
    @yield('header')
    <title>  سكريبت  {{getSetting('siteName')}} |
    @yield('title')

    </title>
</head>
<body style="direction: rtl" >
<div class="header">
    <div class="container"> <a class="navbar-brand" href="{{Route('index')}}"><i class="fa fa-paper-plane"></i> عقارات </a>
        <div class="menu pull-left"> <a class="toggleMenu" href="#"><img src="{{asset('images/nav_icon.png')}}" alt="" /> </a>
            <ul class="nav" id="nav">

                <li class="{{ $active ==13 ? 'current' : ' '}}"><a href="{{url('/')}}">الرئيسيه</a></li>
                <li class="{{$active == 4 ? 'current' : ''}}"><a href="{{url('home/getEstates')}}">كل العقارات</a></li>

                <li class="dropdown" class="@if(isset($estate->estate_rent) && $estate->estate_rent == 0) current @endif" >

                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="flase">
                        ايجار     <span class="caret"> </span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        @foreach(getTheType() as $key=>$type)

                            <li style="width: 100% " class=" @if ($active==10 && $key==0)
                                active
                                @elseif ($active==11 && $key==1)
                                active
                                @elseif ($active==12 && $key==2)
                                active
                                @endif
                                "   >
                                <a href="{{url('/search?estate_rent=0&estate_type='.$key )}}"> {{$type}}</a></li>
                        @endforeach
                    </ul>
                </li>

                <li class="dropdown "  >
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="flase">
                        تمليك     <span class="caret"> </span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        @foreach(getTheType() as $key=>$type)
                            <li style="width: 100%"
                            class="@if ($active==10 && $key==0)
                                active
@elseif ($active==11 && $key==1)
                                active
@elseif ($active==12 && $key==2)
                                active
@endif
                                "
                            ><a href="{{url('/search?estate_rent=1&estate_type='.$key)}}"> {{$type}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="{{ $active == 6 ? 'current' : ''}}"><a href="{{Route('contact-us.index')}}">تواصل معنا</a></li>
                <!-- Authentication Links -->
                @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->role=='admin')
                    <li class="nav-item " >
                        <a class="nav-link" href="{{url('adminPanel')}}">لوحه التحكم</a>
                    </li>
                @endif

                @guest
                    <li class="nav-item {{ $active == 15 ? 'current' : ''}}" >
                        <a class="nav-link" href="{{ route('login') }}">{{ __('تسجيل دخول') }}</a>
                    </li>
                    @if (Route::has('register'))

                        <li class="nav-item {{$active == 16 ? 'current' : ''}}" >
                            <a class="nav-link  " href="{{ route('register') }}">{{ __('تسجيل عضويه جديده') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('تسجيل الخروج') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest

                <div class="clear"></div>
            </ul>

        </div>
    </div>
</div>

    <div id="app">

        <main class="py-4" >
            @yield('content')
        </main>
    </div>

<div class="footer"  >
    <div class="footer_bottom">
        <div class="follow-us"> <a class="fa fa-facebook social-icon" href="#"></a> <a class="fa fa-twitter social-icon" href="#"></a> <a class="fa fa-linkedin social-icon" href="#"></a> <a class="fa fa-google-plus social-icon" href="#"></a> </div>
        <div class="copy">
            <p>{{getSetting('copyRight')}} &copy; {{date('Y')}}  <a href="Http://www.facebook.com" rel="nofollow">Ahmed Salah</a></p>
        </div>
    </div>
</div>

@yield('footer')

{!! Html::script('js/jquery.min.js') !!}

    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.flexslider.js')}}"></script>
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>



</body>
</html>
