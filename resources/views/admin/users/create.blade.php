@extends('admin.layout')

@section('title')
    {{isset($user) ? "تعديل بيانات العضو "
   . $user->name
    : 'انشاء عضو جديد'}}
    @endsection
@section('header')
    <style>
        .card-header:first-child {
            border-radius: calc(.25rem - 0) calc(.25rem - 0) 0 0;
            direction: rtl;
        }
        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem;
            direction: rtl;
        }

    </style>
    @endsection

@section('content')
@include('partial.session')
<div class="content" >
    <div class="row">
@if(isset($user))
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item "><a class="nav-link active" href="#timeline" data-toggle="tab">عقارات مفعله</a></li>
                            <li class="nav-item "><a class="nav-link" href="#activity" data-toggle="tab">عقارات غير مفعله</a></li>

                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="timeline">
                                @if(isset($hisActive) && is_int($hisActive) )
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="alert alert-dark text-center"> لا توجد عقارات  مفعله لهذا العضو</h6>
                                        </div>
                                    </div>
                                @elseif(isset($hisActive) && $hisActive->count()  >0)
                                    <div class="row">
                                        <div >
                                            <table id="example2" class="table table-bordered table-hover">
                                                <thead class="col-md-12">
                                                <tr>
                                                    <th>اسم العقار</th>
                                                    <th>تاريخ الاضافه</th>
                                                    <th> الغاء التفعيل </th>
                                                    <th>تعديل</th>
                                                    <th>حذف</th>
                                                </tr>
                                                </thead>
                                                <tbody >

                                                @foreach($hisActive as $estate)
                                                    <tr>
                                                        <td>   {{Str::limit($estate->estate_name,46)}}</td>
                                                        <td> {{$estate->created_at}}</td>
                                                        <td>
                                                            <form action="{{Route('change.status' , $estate->id)}}">
                                                                @csrf
                                                                @method('PUT')
                                                                <button class="btn btn-info btn-sm" type="submit"> الغاء التفعيل </button>
                                                            </form>

                                                        </td>

                                                        <td>
                                                            <form action="{{Route('estates.edit' , $estate->id)}}">
                                                                @csrf
                                                                <button class="btn btn-info btn-sm" type="submit"> تعديل العقار </button>
                                                            </form>
                                                        </td>

                                                        <td>

                                                            <form action="{{Route('estates.destroy' , $estate->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger btn-sm" type="submit"> حذف العقار </button>
                                                            </form>
                                                        </td>

                                                    </tr>

                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    {{$hisActive->appends(Request::except('page'))->render()}}

                                @endif
                            </div>
                            <div class="tab-pane" id="activity">

                                @if(isset($hisNonActive) && is_int($hisNonActive) )
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="alert alert-dark text-center"> لا توجد عقارات غير مفعله لهذا العضو</h6>
                                        </div>
                                    </div>
                                @elseif(isset($hisNonActive) && $hisNonActive->count()  >0)
                                    <div class="row">
                                        <div >
                                            <table id="example2" class="table table-bordered table-hover">
                                                <thead class="col-md-12">
                                                <tr>
                                                    <th>اسم العقار</th>
                                                    <th>تاريخ الاضافه</th>
                                                    <th>تفعيل العقار</th>
                                                    <th>تعديل</th>
                                                    <th>حذف</th>
                                                </tr>
                                                </thead>
                                                <tbody class="col-md-12">

                                                @foreach($hisNonActive as $estate)
                                                    <tr>
                                                        <td>
                                                            {{Str::limit($estate->estate_name,46)}}

                                                        </td>
                                                        <td> {{$estate->created_at}}</td>
                                                        <td>
                                                            <form action="{{Route('change.status' , $estate->id)}}">
                                                                @csrf
                                                                @method('PUT')
                                                                <button class="btn btn-info btn-sm" type="submit"> تفعيل  </button>
                                                            </form>

                                                        </td>


                                                        <td>
                                                            <form action="{{Route('estates.edit' , $estate->id)}}">
                                                                @csrf
                                                                <button class="btn btn-info btn-sm" type="submit"> تعديل العقار </button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form action="{{Route('estates.destroy' , $estate->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger btn-sm" type="submit"> حذف العقار </button>
                                                            </form>
                                                        </td>

                                                    </tr>

                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{$hisNonActive->appends(Request::except('page'))->render()}}
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-5">
                <div class="card card-default">
                    @include('partial.validation')
                    <div class="card-header text-right" >
                        <hr>
                        <h6>
                            {{isset($user) ? " تعديل بيانات "
     .$user->name
                    : 'انشاء عضو جديد'}}
                        </h6>
                        <hr>
                    </div>

                    <div class="card-body" style=" direction: rtl" >
                        <form method="POST" action="{{ isset($user) ? route('users.update' , $user->id):route('users.store') }}" >
                            @csrf
                            @if(isset($user))
                                @method('PUT')
                            @endif
                            <div class="form-group row">

                                <div class="col-md-9">
                                    <input id="name" type="text" placeholder="الاسم "  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($user) ? $user->name :old('name') }}" required autocomplete="name" autofocus>


                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-9">
                                    <input id="email"    type="email" placeholder="البريد الالكتروني " class="form-control @error('email') is-invalid @enderror" name="email" value="{{ isset($user) ? $user->email :old('email')}}" required autocomplete="email">

                                </div>
                            </div>
                            @if(!isset($user))
                                <div class="form-group row">
                                    <div class="col-md-9">
                                        <input id="password"   placeholder="كلمه المرور" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-md-9">
                                        <input id="password-confirm"   placeholder="أعد كتابه كلمه المرور" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                            @endif
                            @if(isset($user))
                                <div class="form-group row">

                                    <div class="col-md-9" >
                                        <select class="form-control" name="role">
                                            <option
                                                @if($user->role=='admin')
                                                selected
                                                @endif
                                            >Admin</option>
                                            <option
                                                @if($user->role=='user')
                                                selected
                                                @endif
                                            >User</option>
                                        </select>
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">

                                    <div class="col-md-9" >
                                        <select class="form-control" name="role">
                                            <option>مدير</option>
                                            <option selected>عضو </option>
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row mb-0">
                                <div class="col-md-3 ">
                                    <button type="submit" class="btn btn-success " style="width: 200px">
                                        {{isset($user) ? 'تعديل' : ' تسجيل'}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if(isset($user))
                    <div class="card card-default">
                        <div class="card-header text-right" >
                            <hr>
                            <h6>
                                تعديل كلمه المرور
                            </h6>
                            <hr>
                        </div>

                        <div class="card-body" style=" direction: rtl" >
                            <form method="POST" action="{{ route('users.update' , $user->id)}}" >
                                @csrf

                                <div class="form-group row">
                                    <div class="col-md-9">
                                        <input id="password"  placeholder="كلمه المرور" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-sm-4 ">
                                        <button type="submit" class="btn btn-success " >
                                            تعديل كلمه المرور
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        @if($user->role=='user')
                                            <form action="{{Route('users.destroy' , $user->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button style="width: 150px" class="btn btn-danger " type="submit"> حذف العضو  </button>
                                            </form>
                                        @endif
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
    @else
            <div class="col-md-12">
                <div class="card card-default">
                    @include('partial.validation')
                    <div class="card-header text-right" >
                        <hr>
                        <h6>
                            {{isset($user) ? " تعديل بيانات "
     .$user->name
                    : 'انشاء عضو جديد'}}
                        </h6>
                        <hr>
                    </div>

                    <div class="card-body" style=" direction: rtl" >
                        <form method="POST" action="{{ isset($user) ? route('users.update' , $user->id):route('users.store') }}" >
                            @csrf
                            @if(isset($user))

                            @endif
                            <div class="form-group row">

                                <div class="col-md-9">
                                    <input id="name" type="text" placeholder="الاسم "  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($user) ? $user->name :old('name') }}" required autocomplete="name" autofocus>


                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-9">
                                    <input id="email"    type="email" placeholder="البريد الالكتروني " class="form-control @error('email') is-invalid @enderror" name="email" value="{{ isset($user) ? $user->email :old('email')}}" required autocomplete="email">

                                </div>
                            </div>
                            @if(!isset($user))
                                <div class="form-group row">
                                    <div class="col-md-9">
                                        <input id="password"   placeholder="كلمه المرور" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-md-9">
                                        <input id="password-confirm"   placeholder="أعد كتابه كلمه المرور" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                            @endif
                            @if(isset($user))
                                <div class="form-group row">

                                    <div class="col-md-9" >
                                        <select class="form-control" name="role">
                                            <option
                                                @if($user->role=='admin')
                                                selected
                                                @endif
                                            >Admin</option>
                                            <option
                                                @if($user->role=='user')
                                                selected
                                                @endif
                                            >User</option>
                                        </select>
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">

                                    <div class="col-md-9" >
                                        <select class="form-control" name="role">
                                            <option>مدير</option>
                                            <option selected>عضو </option>
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row mb-0">
                                <div class="col-md-3 ">
                                    <button type="submit" class="btn btn-success " style="width: 200px">
                                        {{isset($user) ? 'تعديل' : ' تسجيل'}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if(isset($user))
                    <div class="card card-default">
                        <div class="card-header text-right" >
                            <hr>
                            <h6>
                                تعديل كلمه المرور
                            </h6>
                            <hr>
                        </div>

                        <div class="card-body" style=" direction: rtl" >
                            <form method="POST" action="{{ route('users.update' , $user->id)}}" >
                                @csrf
                                @method('PUT')

                                <div class="form-group row">
                                    <div class="col-md-9">
                                        <input id="password"  placeholder="كلمه المرور" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-sm-4 ">
                                        <button type="submit" class="btn btn-success " >
                                            تعديل كلمه المرور
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        @if($user->role=='user')
                                            <form action="{{Route('users.destroy' , $user->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button style="width: 150px" class="btn btn-danger " type="submit"> حذف العضو  </button>
                                            </form>
                                        @endif
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        @endif


    </div>
</div>
    @endsection
