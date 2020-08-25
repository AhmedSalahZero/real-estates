

<div class="col-md-3">
    @if(Auth::user())
        <div class="profile-sidebar">
            <h2 class="text-center">
                خيارات العضو
            </h2>
            <div class="profile-usermenu">
                <ul class="nav" style="padding-right: 0px;margin-right: 0px">
                    <li class="{{($active == 1 ?  'active' :"")}}">
                        <a href="{{Route('editData')}}">
                            <i class="fa fa-edit"></i>
                            تعديل بياناتي</a>
                    </li>
                    <li>
                        <a href="{{route('user.add')}}">
                            <i class="fa fa-plus"></i>
                            اضف عقار </a>
                    </li>
                    <li class="{{( $active == 2 ? 'active' : '')}}">
                        <a href="{{route('showMyEstateActive')}}">
                            <i class="fa fa-check"></i>
                            عقاراتي المفعله

                        <label class="label label-info" >
                            {{App\Estate::where('user_id' , Auth()->user()->id)->where('estate_status',1)->count()}}
                        </label>
                        </a>
                    </li>

                    <li class="{{(  $active == 3 ? 'active' : '')}}" >
                        <a  href="{{Route('showNonActive')}}">
                            <i class="fa fa-clock-o"></i>
                            عقارتي الغير مفعله
                            <label class="label label-danger" >
                                {{App\Estate::where('user_id' , Auth()->user()->id)->where('estate_status',0)->count()}}
                            </label>

                        </a>
                    </li>
                </ul>
            </div>
            <!-- END MENU -->
        </div>
        @endif
    <br>
    <div class="profile-sidebar">
        <h2 class="text-center">
            خيارات العقارات
        </h2>
        <div class="profile-usermenu">
            <ul class="nav" style="padding-right: 0px;margin-right: 0px">
                <li class="{{  $active == 4 ? "active" : " "}}">
                    <a href="{{Route('getEstates.index')}}">
                        <i class="fa fa-building"></i>
                        كل العقارات </a>
                </li>
                <li class="{{ $active == 8 ? "active" : ""}}">
                    <a href="{{url('forRent')}}">
                        <i class="fa fa-calendar-o"></i>
                        ايجار </a>
                </li>
                <li class="{{ $active == 9 ? "active" : ""}}">
                    <a href="{{url('forBuy')}}">
                        <i class="fa fa-building-o"></i>
                        تمليك </a>
                </li>
                <li class="{{ $active == 10 ? "active ": "" }}">
                    <a href="{{url('type/0')}}">
                        <i class="fa fa-home"></i>
                        شقه </a>
                </li>
                <li class="{{ $active == 11 ? "active" : " "}}">
                    <a href="{{url('type/1')}}">
                        <i class="fa fa-building"></i>
                        فيلا </a>
                </li>
                <li class="{{ $active == 12 ? "active" : " "}}">
                    <a href="{{url('type/2')}}">
                        <i class="fa fa-institution"></i>
                        شاليه </a>
                </li>

            </ul>
        </div>
        <!-- END MENU -->
    </div>
    <br>
    <div class="profile-sidebar">
        <h2 class="text-center">
            البحث المتقدم
        </h2>

        <div class="profile-usermenu" style="padding: 10px">
            <ul class="nav" style="padding-right: 0px;margin-right: 0px">
                {!! Form::open(['url'=>'/search' ]) !!}
                @method('GET')
                <li class="item">
                    {{Form::text('estate_price_from',null,['class'=>'form-control' , 'placeholder'=>'سعر العقار من'])}}
                </li>
                <li class="item">
                    {{Form::text('estate_price_to',null,['class'=>'form-control' , 'placeholder'=>' سعر العقار الي'])}}
                </li>
                <li class="item">
                    {{Form::select('estate_location',getLocations(),null,['class'=>'form-control ourSelect' , 'placeholder'=>'موقع العقار'])}}
                </li>
                <li class="item">
                    {{Form::select('estate_rooms',roomNumber(),null,['class'=>'form-control' , 'placeholder'=>'عدد الغرف'])}}
                </li>
                <li class="item">
                    {{Form::select('estate_type',getTheType(),null,['class'=>'form-control' , 'placeholder'=>'نوع العقار'])}}
                </li>
                <li class="item">
                    {{Form::select('estate_rent',getRent(),null,['class'=>'form-control' , 'placeholder'=>'نوع العمليه'])}}
                </li>
                <li class="item">
                    {{Form::text('estate_area',null,['class'=>'form-control' , 'placeholder'=>'المساحه'])}}
                </li>
                <li style="padding-right: 80px ; padding-top: 20px">
                    {!! Form::submit('ابحث',['class'=>'btn btn-sm btn-success']) !!}
                </li>
                {!! Form::close() !!}


            </ul>
        </div>
        <!-- END MENU -->
    </div>



</div>
