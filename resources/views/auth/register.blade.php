@extends('layouts.app')
@section('title')
    تسجيل عضويه جديده
    @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header text-center" >
                    <hr>
                <h3>تسجيل عضويه جديده</h3>
                <hr>
                </div>

                <div class="card-body " style="   float: right" >
                    <form method="POST" action="{{ route('register') }}" >
                        @csrf
                        <div class="form-group row">

                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="الاسم " style="width: 600px" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-6">
                                <input id="email"  style="width: 600px"  type="email" placeholder="البريد الالكتروني " class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="password"  style="width: 600px"  placeholder="الباسورد" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-6">
                                <input id="password-confirm"  style="width: 600px"  placeholder="أعد كتابه كلمه المرور" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-3 ">
                                <button type="submit" class="btn btn-success " style="width: 200px">
                                    تسجيل
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
