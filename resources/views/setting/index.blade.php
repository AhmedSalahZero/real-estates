@extends('admin.layout')
@section('title')
   اعدادات الموقع
@endsection
@section('header')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"> اعدادات الموقع</li>
    <li class="breadcrumb-item " > <a href="{{url('adminPanel')}}" >لوحه التحكم</a> </li>
    @endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header " style="margin: auto">
                        <h3 class="card-title">اعدادت الموقع</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pull-right "style="direction: rtl " >
                        @include('partial.session')
                        <form action="{{Route('setting.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                                @foreach($settings as $setting)
                            <div class="form-group ">

                            <div class="col-md-8 ">

                                {!!  Form::label("$setting->settingName", "$setting->slug" ) !!}
                            </div>

                                    <div class="col-md-12 mb-4">
                                            @if($setting->type==0)
                                                {{ Form::text($setting->settingName,$setting->value,['class' => 'form-control'] )}}
                                        @elseif($setting->type==4)
                                            <input type="number" name="{{$setting->settingName}}" value="{{$setting->value}}" class="form-control">
                                        @elseif($setting->type==2)
                                           <input type="file" name="{{$setting->settingName}}" class="form-control">
                                            @else
                                                {{ Form::textarea($setting->settingName,$setting->value,['class' => 'form-control'] )}}
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="col-md-8">
                                        <button class="btn btn-app" type="submit" >
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
