@extends('admin.layout')
@section('header')
    <link href="{{asset('select/css/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('title')
    {{isset($estate) ? "تعديل بيانات العقار "
   . $estate->estate_name
    : 'اضافه عقار جديد'}}
    @endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">
    {{isset($estate) ?'تعديل عقار '.$estate->user->name

 :" اضافه عقار جديد"}}


    </li>
    <li class="breadcrumb-item "> <a href="{{url('adminPanel/estates')}}" >التحكم في العقارات</a> </li>
    <li class="breadcrumb-item " > <a href="{{url('adminPanel')}}" >لوحه التحكم</a> </li>
@endsection
@section('content')
    <div class="card card-default">
        <div class="card-header" style="direction: rtl">
            <hr>
            <div class="col-md-7">
                <h3 class="card-title">
                    {{isset($estate) ? " تعديل بيانات العقار "
         : 'انشاء عقار جديد'}}
                    <hr>
                </h3>
            </div>
        </div>

        <div class="card-body" style=" direction: rtl" >
            @if(isset($estate))
<h6 class="alert alert-default-info text-center"> تم اضافه هذا العقار بواسطه
{{$estate->user->name}}
    <br> <br>
    تاريح الاضافه :
    {{$estate->created_at}}
<br> <br>
    البريد الالكتروني:
    {{$estate->user->email}}
    <br> <br>
    الصلاحيات  :
    @if($estate->user->role =='user' )
        عضو
        @else
        مدير
    @endif
</h6>
            @endif

            <form method="POST"  enctype="multipart/form-data" action="{{ isset($estate) ? route('estates.update' , $estate->id):route('estates.store') }}" >
                @csrf
                @if(isset($estate))
                    @method('PUT')
                    <div class="text-center">
                        <img src="{{asset($estate->estate_image)}}" style="width: 30% ; height: 250px">
                    </div>
                <hr>
                    <br>

                    @endif


                <div class="form-group row">
                    <div class="col-md-1">
                        <label for="name"> اسم العقار </label>
                    </div>

                    <div  style="margin-right: 250px ;">
                        <input id="name" type="text" style="width: 600px" class="form-control @error('name') is-invalid @enderror" name="name" value="{{isset($estate) ? $estate->estate_name :old('name') }}"  autocomplete="name" >
                        @if($errors->has('name'))
                        <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{$errors->first('name') }}</strong>
                                    </span>
                        @endif

                    </div>
                </div>



                <div class="form-group row">
                    <div class="col-md-1">
                        <label for="price" >سعر العقار</label>
                    </div>
                    <div  style="margin-right: 250px ;">
                        <input id="price"  style="width: 600px"  type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ isset($estate) ? $estate->estate_price :old('price')}}"  autocomplete="price">
                        @if($errors->has('price'))
                            <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-1">
                        <label for="area" >مساحه العقار</label>
                    </div>
                    <div style="margin-right: 250px ;">
                        <input id="area" type="text" style="width: 600px" class="form-control @error('area') is-invalid @enderror" name="area" value="{{isset($estate) ? $estate->estate_area :old('area') }}"  autocomplete="area" >
                        @if($errors->has('area'))
                            <span class="invalid-feedback text-right" role="alert" >
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-1">
                        <label for="room" >عدد الغرف</label>
                    </div>
                    <div style="margin-right: 250px ;">
                        <input id="room" type="number" style="width: 600px" class="form-control @error('area') is-invalid @enderror" name="room" value="{{isset($estate) ? $estate->estate_rooms :old('room') }}"  autocomplete="room" >
                        @if($errors->has('room'))
                            <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{$errors->first('room') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-1">
                        <label for="rent" >نوع العمليه</label>
                    </div>
                    <div style="margin-right: 250px ;">
                        <select style="width: 600px" class="form-control" name="rent" id="rent">
                            <option value="0"
                            @if(isset($estate) && $estate->estate_rent==0)
                                selected
                                @endif
                            > ايجار </option>
                            <option value="1"
                                    @if(isset($estate) && $estate->estate_rent==1)
                                    selected
                                @endif
                            > تمليك </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-1">
                        <label for="type" >نوع العقار</label>
                    </div>
                    <div style="margin-right: 250px ;">
                        <select style="width: 600px" class="form-control" name="type" id="type">
                            <option value="0" {{(isset($estate) && $estate->estate_type==0) ? 'selected' :''}}> شقه </option>
                            <option value="1" {{(isset($estate) && $estate->estate_type==1) ? 'selected' :''}}> فيلا </option>
                            <option value="2" {{(isset($estate) && $estate->estate_type==2) ? 'selected' :''}}>  شاليه </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-1">
                        <label for="status" >حاله العقار</label>
                    </div>
                    <div style="margin-right: 250px ;">
                        <select style="width: 600px" class="form-control" name="status" id="status">
                            <option value="1" {{(isset($estate) && $estate->estate_status==1) ? 'selected' :''}}> مفعل </option>
                            <option value="0" {{(isset($estate) && $estate->estate_status==0) ? 'selected' :''}}> غير مفعل </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-1">
                        <label for="longitude" >خط الطول</label>
                    </div>
                    <div  style="margin-right: 250px ;">
                        <input id="longitude"  style="width: 600px"  type="number" class="form-control @error('area') is-invalid @enderror" name="longitude" value="{{ isset($estate) ? $estate->estate_longitude :old('longitude')}}"  autocomplete="longitude">
                        @if($errors->has('longitude'))
                            <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{$errors->first('longitude') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-1">
                        <label for="latitude" >دائره العرض</label>
                    </div>
                    <div  style="margin-right: 250px ;">
                        <input id="latitude"  style="width: 600px"  type="number" class="form-control @error('latitude') is-invalid @enderror " name="latitude" value="{{ isset($estate) ? $estate->estate_latitude :old('latitude')}}"  autocomplete="latitude">
                        @if($errors->has('latitude'))
                            <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{$errors->first('latitude') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-1">
                        <label for="image" >صوره للعقار</label>
                    </div>
                    <div style="margin-right: 250px  ">
                        <input  style="width: 600px" type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" >
                        @if($errors->has('image'))
                            <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                        @endif
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-md-1">
                        <label for="location">موقع العقار </label>
                    </div>
                    <div  style="margin-right: 250px ;">

   <select name="location" id="location" class="form-control ourSelect " style="width: 600px  "  >

       @foreach(getLocations() as $key=>$val )

            <option value="{{$key}}"
                    @if(isset($estate))
                    @if($estate->estate_location==$key) selected @endif>
                @endif
                >

                {{$val}}

            </option>
            @endforeach
   </select>
{{--                        {{ Form::select('location',isset($estate) ? $estate->estate_location :getLocations() ,null , ['class'=>"ourSelect form-control  " ,'style'=>'width: 600px ' ,'id'=>'location' ])   }}--}}
{{--
   <input id="location" type="" style="width: 600px" class="form-control @error('keywords') is-invalid @enderror " name="location" value="{{isset($estate) ? $estate->estate_location :old('location') }}"  autocomplete="location" >--}}
                        @if($errors->has('location'))
                            <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{$errors->first('location') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-1">
                        <label for="keywords"> الكلمات الدلائليه </label>
                    </div>
                    <div  style="margin-right: 250px ;">
                        <input id="keywords" type="text" style="width: 600px" class="form-control @error('keywords') is-invalid @enderror " name="keywords" value="{{isset($estate) ? $estate->estate_keywords :old('keywords') }}"  autocomplete="keywords" >
                        @if($errors->has('keywords'))
                            <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{$errors->first('keywords') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-1">
                        <label for="sm_desc" >وصف العقار لمحركات البحث </label>
                    </div>
                    <div  style="margin-right: 250px ;">
                        <textarea id="sm_desc" type="text" cols="5" rows="5" style="width: 600px" class="form-control @error('sm_desc') is-invalid @enderror" name="sm_desc"  required> {{isset($estate) ? $estate->estate_small_desc :old('sm_desc') }} </textarea>
                        @if($errors->has('sm_desc'))
                            <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{$errors->first('sm_desc') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-md-1">
                        <label for="large_desc" >وصف مطول للعقار </label>
                    </div>
                    <div  style="margin-right: 250px ;">
                        <textarea id="large_desc" type="text" cols="10" rows="10" style="width: 600px" class="form-control  @error('large_desc') is-invalid @enderror" name="large_desc"  required> {{isset($estate) ? $estate->estate_large_desc :old('large_desc') }} </textarea>
                        @if($errors->has('large_desc'))
                            <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{$errors->first('large_desc') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
{{--               another way to write select using an array as return--}}
{{--                   {!! Form::select('x',getx() ,['class'=>'form-control'] )!!}--}}

                <div class="form-group row mb-0">
                    <div class="col-md-7">
                        <button type="submit" class="btn btn-outline-dark " style="width: 200px">
                            @if(isset($estate))
                                تعديل العقار
                                @else
                                اضافه العقار
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @endsection

@section('footer')
    <script src="{{asset('select/js/select2.min.js')}}"></script>
    <script type="text/javascript">

        $('.ourSelect').select2({
            dir: "rtl"
        });

    </script>
    @endsection
