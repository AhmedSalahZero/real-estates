@extends('layouts.app')

@section('title')
    تواصل معانا
    @endsection

@section('header')
   <style>
       .jumbotron {
           background: #358CCE;
           color: #FFF;
           border-radius: 0px;
       }
       .jumbotron-sm { padding-top: 24px;
           padding-bottom: 24px; }
       .jumbotron small {
           color: #FFF;
       }
       .h1 small {
           font-size: 24px;
       }
   </style>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    @endsection

@section('content')
    <br> <br>
    <div class="container">
        <h1>تواصل معانا</h1>
        <div class="row">
            <div class="col-md-8">
                <div class="well well-sm">
                    @include('partial.session')
                    <form action="{{Route('contact-us.store')}}" method="POST" >
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                        الرساله</label>
                                    <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror " rows="9" cols="25" required="required"
                                              placeholder="محتوى الرساله">{{old('message')}}</textarea>
                                </div>
                                @error('message')
                                <span class="invalid-feedback alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                        الاسم</label>
                                    <input type="text" value="{{\Illuminate\Support\Facades\Auth::user() ? \Illuminate\Support\Facades\Auth::user()->name : ''}}" class="form-control" id="name" placeholder="أدخل الاسم" name="name"  required="required" />
                                    @error('name')
                                    <div class="alert-danger alert">
                                        {{$message}}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="email">
                                        البريد الالكتروني</label>
                                    <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                        <input type="email" value="{{\Illuminate\Support\Facades\Auth::user() ? \Illuminate\Support\Facades\Auth::user()->email : ''}}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="ادخل البريد الالكتروني" required="required" /></div>

                                </div>
                                <div class="form-group">
                                    <label for="subject">
                                        الموضوع</label>
                                    <select id="subject" name="subject" class="form-control" required="required">

                                        @foreach(contact() as $key=>$val)
                                            <option value="{{$key}}">{{$val}}</option>
                                            @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="banner_btn pull-right" id="btnContactUs">
                                   ارسل الرساله</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <form>
                    <legend><i class="fa fa-outdent"></i> مكتبنا</legend>
                    <address>

                        <strong>عنوان الفرع</strong><br>

                       {{getSetting('address')}} <br> <br>
                        <strong>الهواتف</strong><br>
                        {{getSetting('phone1')}} <br>
                        {{getSetting('phone2')}}
                    </address>
                    <address>
                        <strong>البريد الالكتروني</strong><br>
                        <a href="mailto:#">{{getSetting('email')}}</a>
                    </address>
                </form>
            </div>
        </div>
    </div>
    @endsection

@section('footer')

    @endsection
