@extends('admin.layout')
@section('title')
    رسائل الزوار
@endsection
@section('header')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">  رسائل الزوار</li>
    <li class="breadcrumb-item " > <a href="{{url('adminPanel')}}" >لوحه التحكم</a> </li>
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if(App\Contact::all()->count()>0)
                        <div class="card-header" style="direction: rtl">
                            <div class="col-md-7">
                                <h3 class="card-title">
                                    رسائل الزوار
                                </h3>
                            </div>
                        </div>
                @endif
                <!-- /.card-header -->
                    <div class="card-body">
                        @if(App\Contact::all()->count()>0)
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>حذف</th>
                                    <th>تحديد كمقرؤ</th>
                                    <th>تاريخ الاضافه</th>
                                    <th>الحاله</th>
                                    <th>نص الرساله</th>
                                    <th>نوع الرساله</th>
                                    <th> البريد الالكتروني </th>
                                    <th>اسم المرسل</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                @include('partial.session')


                                <tbody>

                                @foreach($contacts as $contact)
                                    <tr>

                                        <td>
                                            <form action="{{Route('contact.destroy' , $contact->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit">حذف الرساله </button>
                                            </form>

                                        </td>
                                        <td>
                                           @if($contact->view==0)
                                                <form action="{{Route('contact.read' , $contact->id)}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button class="btn btn-info btn-sm" type="submit">تحديد كمقرؤ </button>
                                                </form>

                                               @endif
                                        </td>
                                        <td> {{$contact->created_at }}</td>
                                        <td> {{($contact->view==0 ? 'غير مقرؤه' : 'تمت القراءه')}}</td>
                                        <td> {{$contact->message}}</td>
                                        <td> {{contact()[$contact->subject]}}</td>
                                        <td> {{$contact->email}}</td>
                                        <td> {{$contact->name}}</td>
                                        <td> {{$contact->id}}</td>
                                    </tr>

                                @endforeach
                                </tbody>


                            </table>
                        @else
                            <div class="alert about-info text-center " style="color: #4f5962 ; "> لا يوجد رسائل  حتى الان </div>
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
