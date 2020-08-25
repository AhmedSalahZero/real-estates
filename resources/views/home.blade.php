@extends('layouts.app')
@section('title')
    الصفحة الرئيسية
@endsection
@section('header')
    @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <br><br><br><br><br> <br><br><br><br><br>
                       <div class="alert alert-success text-center"  >
                           تم تسجيل الدخول بنجاح
                       </div>

               <br><br><br><br><br> <br><br><br><br><br> <br><br><br><br><br> <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
