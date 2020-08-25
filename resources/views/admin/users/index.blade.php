@extends('admin.layout')
@section('title')
    التحكم في الاعضاء
@endsection
@section('header')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    @endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        @include('partial.session')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if(App\User::where('role','user')->count()>0)
                    <div class="card-header" style="direction: rtl">
                        <div class="col-md-7">
                            <h3 class="card-title">
                                بيانات الاعضاء
                            </h3>

                        </div>
                    </div>
                @endif
                    <!-- /.card-header -->

                    <div class="card-body">
<form action="{{Route('users.index')}}">
    @csrf
</form>
                    @if(App\User::where('role','user')->count()>0)
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>حذف</th>
                                <th>تعديل</th>
                                <th> عقارات العضو </th>
                                <th>تاريخ التسجيل</th>
                                <th>الصلاحيات</th>
                                <th>البريد الالكتروني</th>
                                <th>اسم المستخدم </th>
                                <th>الصوره الرمزيه</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($users as $user)
                                <tr>
                                   @if($user->role=='user')
                                        <td>
                                            <form action="{{Route('users.destroy' , $user->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit"> حذف </button>
                                            </form>
                                        </td>

                                    @else
                                       <td></td>
                                       @endif
                                    <td>
                                        <form action="{{Route('users.edit' , $user->id)}}">
                                            @csrf
                                            <button class="btn btn-info btn-sm" type="submit"> تعديل </button>
                                        </form>
                                    </td>
                                       <td>
                                           <form action="{{Route('estates.user',$user->id)}}">
                                               @csrf
                                               <button class="btn btn-info btn-sm" type="submit"> عرض </button>
                                           </form>
                                       </td>

                                    <td> {{$user->created_at}}</td>
                                    <td> {{($user->role=='admin') ? 'مدير' : 'عضو'}}</td>
                                    <td> {{$user->email}}</td>
                                    <td> {{$user->name}}</td>
                                    <td>
                                        <img src="{{$user->image}}" alt=""  style=" width:50px; height: 50px">
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>


                        </table>
                        @else
                            <div class="alert about-info text-center " style="color: #4f5962 ; "> لا يوجد اعضاء حتى الان </div>
                        @endif

                    </div>
                <div class="" style="margin:auto"> {{$users->links()}} </div>
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
    <script type="text/javascript">
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
            </script>
    @endsection
