@extends('admin.layout')
@section('title')
   التحكم في العقارات
@endsection
@section('header')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    @endsection
@section('breadcrumb')


   @if(isset($active) && $active == 'non')
          <li class="breadcrumb-item " > <a >عقارات غير مفعله</a> </li>
          <li class="breadcrumb-item " > <a href="{{url('adminPanel/estates')}}" >جميع العقارات</a> </li>
       @elseif(isset($active ) && $active=='all')
       <li class="breadcrumb-item active" > <span > العقارات المفعله</span> </li>
   @elseif(isset($active ) && $active=='allNon')
       <li class="breadcrumb-item active" > <span > العقارات غير مفعله</span> </li>
       @elseif(isset($active ))
       <li class="breadcrumb-item active" > <span > عقارات {{($estates->first()->user->name)}}</span> </li>
       <li class="breadcrumb-item " > <a href="{{url('adminPanel/estates')}}" >جميع العقارات</a> </li>
    @else
       <li class="breadcrumb-item active">جميع العقارات </li>
    @endif

   <li class="breadcrumb-item " > <a href="{{url('adminPanel')}}" >لوحه التحكم</a> </li>
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if(App\Estate::all()->count()>0)
                    <div class="card-header" style="direction: rtl">
                       <div class="col-md-7">
                           <h3 class="card-title">
                              بيانات العقارات
                           </h3>
                       </div>
                    </div>
                @endif
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if(App\Estate::all()->count()>0)
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>حذف</th>
                                <th>تعديل</th>
                                <th>الحاله</th>
                                <th>تاريخ الاضافه</th>
                                <th>البائع</th>
                                <th>عدد الغرف</th>
                                <th>المساحه</th>
                                <th>النوع</th>
                                <th>السعر </th>
                                <th>اسم العقار</th>
                                <th>صوره رمزيه</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            @include('partial.session')


                            <tbody>

                            @foreach($estates as $estate)
                                <tr>

                                        <td>
                                            <form action="{{Route('estates.destroy' , $estate->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit"> حذف العقار </button>
                                            </form>
                                        </td>
                                    <td>
                                        <form action="{{Route('estates.edit' , $estate->id)}}">
                                            @csrf
                                            <button class="btn btn-info btn-sm" type="submit"> تعديل العقار </button>
                                        </form>
                                    </td>


                                    <td> {{($estate->estate_rent==0) ?'ايجار' : 'تمليك'}}</td>
                                    <td> {{$estate->created_at}}</td>
                                    <td> {{($estate->user->name)}}</td>
                                    <td> {{$estate->estate_rooms}}</td>
                                    <td> {{$estate->estate_area}}</td>
                                    <td>

                                    @if($estate->estate_type==0)
                                        شقه
                                        @elseif($estate->estate_type==1)
                                        فيلا
                                        @else
                                        شاليه
                                        @endif

                                    </td>
                                    <td>جنيه  {{$estate->estate_price}} </td>
                                    <td> {{$estate->estate_name}}</td>
                                    <td>
                                        <img src="{{asset($estate->estate_image)}}" alt="{{$estate->name}}"  style=" width:100px; height: 70px">
                                    </td>
                                    <td> {{$estate->id}}</td>
                                </tr>

                            @endforeach
                            </tbody>


                        </table>
                        @else
                            <div class="alert about-info text-center " style="color: #4f5962 ; "> لا يوجد عقارات حتى الان </div>
                        @endif

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

@section('footer')
    <!-- DataTables -->
    <script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('dist/js/demo.js')}}"></script>
    <!-- page script -->

    @endsection
