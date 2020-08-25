<?php

namespace App\Http\Controllers;

use App\Estate;
use App\Http\Requests\CreateEstateRequest;
use App\Http\Requests\updateUserRequest;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

class EstatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.estates.index')->with('estates' , Estate::all() );
    }
    public function getNonActive(){

        return view('admin.estates.index')->with('estates' , Estate::where('estate_status' , 0)->get())->with('active','non');
    }

    public function ShowEstateForUser(User $user)
    {
        $estates = $user->estates;
        if ($estates->count() == 0 )
        {
            session()->flash('fail' ,'لا توجد عقارات لهذا العضو حتى الان');
            return redirect()->back();
        }


        return view('admin.estates.index')->with('estates' ,  $estates)->with('active',81);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.estates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
        $rules = [
            'name'=>'required|min:5|max:100',
            'price'=>'required'  ,
            'area'=>'max:5|min:3',
            'room'=>'required' ,
            'longitude'=>'required' ,
            'latitude'=>'required' ,
            'keywords'=>'min:5|max:200',
            'sm_desc'=>'required|min:5|max:160',
            'large_desc'=>'required|min:5|max:160',
            'location'=>'required' ,
            'image'=>'image|required'
        ];
        $customMessages = [
            'name.required' => 'لابد من اضافه اسم العقار' ,
            'price.required' => 'لابد من اضافه سعر العقار' ,
            'area.min' => 'يجب الا تقل المساحه عن 3 احرف ' ,
            'area.max' => 'يجب الا تزيد المساحه  عن 5 احرف ' ,
            'room.required' => 'لابد من اضافه عدد غرف العقار' ,
            'integer'=>' يجب ادخال اعداد صحيحه فقط ' ,
            'longitude.required'=>'لابد من اضافه خط الطول',
            'latitude.required'=>'لابد من اضافه دائره العرض',
            'keywords.min'=>'يجب الا تقل الكلمات الدلائليه عن 5 احرف',
            'keywords.max'=>'يجب الا تزيد الكلمات الدلائليه عن 200 حرف',
            'sm_desc.required'=>'يجب اضافه وصف ',
            'sm_desc.max'=>'لا يمكن ان تزيد حروف الكلمات الدلائليه الخاصه بمحرك البحث عن160 حرف حسب معاير جوجل ',
            'min'=>'اقل عدد من الاحرف هو 5 احرف ',
            'large_desc.required'=>'يجب ادخال وصف للعقار ',
            'large_desc.min'=>'لا يمكن ان يقل الوصف عن 10 احرف ' ,
            'location.required'=>'يجب ادخال موقع العقار' ,
            'image.image'=>"امتداد الملف غير مدعم",
            'image.required'=>'يجب ادخال صوره للعقار'

        ];
        $this->validate($request, $rules, $customMessages);


//       try{
//           $this->validate($request, $rules, $customMessages);
//       }
//
//       catch (Exception $exception)
//       {
//           dd($exception->getMessage());
//
//       }
      


        $image = time().($request->image->getClientOriginalName());
        $request->image->move('uploads/images' , $image);
        $imagePath = 'uploads/images/'.$image ;
        $estate = new Estate();
        $data =$request->all();
        $data['image']=$imagePath;
        $estate->estate_name=$data['name'];
        $estate->estate_price=$data['price'];
        $estate->estate_rent=$data['rent'];
        $estate->estate_area=$data['area'];
        $estate->estate_type=$data['type'];
          $estate->estate_status=$data['status'];
          $estate->estate_small_desc=$data['sm_desc'];
        $estate->estate_large_desc=$data['large_desc'];
        $estate->estate_keywords=$data['keywords'];
        $estate->estate_longitude=$data['longitude'];
        $estate->estate_latitude=$data['latitude'];
        $estate->estate_location=$data['location'];
        $estate->estate_rooms=$data['room'];
        $estate->estate_image=$data['image'];
        $estate->user_id=Auth()->user()->id   ;
        $estate->save();
        session()->flash('success' , 'تم اضافه العقار بنجاح');
        return redirect()->route('estates.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Estate $estate)
    {
        return view('admin.estates.create')->with('estate' , $estate);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estate $estate)
    {
        $rules = [
            'name'=>'min:5|max:100',
            'price'=>'numeric'  ,
            'area'=>'min:3 | max:5',
            'room'=>'min:1' ,
            'longitude'=>'min:2' ,
            'latitude'=>'min:2' ,
            'keywords'=>'min:5|max:200',
            'sm_desc'=>'min:5|max:160',
            'large_desc'=>'min:10',
            'image'=>'image'
        ];

        $customMessages = [
            'name.min' => 'لا يمكن ان يقل اسم العقار عن 5 احرف ' ,
            'name.max' => 'لا يمكن ان يزيد اسم العقار عن 100 حرف ' ,
            'price.numeric' => 'لابد من اضافه سعر العقار' ,
            'area.min' => 'يجب الا تقل المساحه عن 3 احرف ' ,
            'area.max' => 'يجب الا تقل المساحه عن 5 احرف ' ,
            'room.min'=>'يجب ادخال عدد الغرف' ,
            'longitude.min'=>'يجب ادخال رقمين علي الاقل',
            'latitude.min'=>'يجب ادخال رقمين علي الاقل',
            'keywords.min'=>'يجب الا تقل الكلمات الدلائليه عن 5 احرف',
            'keywords.max'=>'يجب الا تزيد الكلمات الدلائليه عن 200 حرف',
            'sm_desc.min'=>'لا يمكن ان يقل الوصف عن 5',
            'sm_desc.max'=>'لا يمكن ان تزيد حروف الكلمات الدلائليه الخاصه بمحرك البحث عن160 حرف حسب معاير جوجل ',
            'min'=>'اقل عدد من الاحرف هو 5 احرف ',
            'large_desc.min'=>'لا يمكن ان يقل الوصف عن 10 احرف ' ,
            'image.image'=>"امتداد الملف غير مدعم"


        ];

        $this->validate($request, $rules, $customMessages);
        if ($request->has('image'))
        {
            if($estate->estate_image != 'uploads/images/default.jpg' && file_exists($estate->estate_image))
            unlink($estate->estate_image);
            $imageSize = getimagesize($request->image);
            $image = time().($request->image->getClientOriginalName());
            $request->image->move('uploads/images' , $image);
            if($imageSize[0]!=1200 || $imageSize!=800)
            {
                $thumbPath = 'uploads/images/thumbs/'.$image;
                Image::make('uploads/images/'. $image)->resize(1200,800)->save($thumbPath,100) ;
                $imagePath = $thumbPath ;

            }
            else{
                $imagePath = 'uploads/images/'.$image;
            }



        }
        else{
            $imagePath = $estate->estate_image ;

        }

        $estate->update([
            $estate->estate_name=$request->name ,
            $estate->estate_price=$request->price ,
            $estate->estate_rent=$request->rent ,
            $estate->estate_area=$request->area ,
            $estate->estate_type=$request->type ,
            $estate->estate_status=$request->status ,
            $estate->estate_small_desc=$request->sm_desc  ,
            $estate->estate_large_desc=$request->large_desc ,
            $estate->estate_keywords=$request->keywords ,
            $estate->estate_longitude=$request->longitude,
            $estate->estate_latitude=$request->latitude ,
            $estate->estate_rooms=$request->room ,
            $estate->estate_image=$imagePath

        ]);
        session()->flash('success' , 'تم تعديل العقار بنجاح');
        return redirect()->route('estates.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estate $estate)
    {
        $estate->delete();
        session()->flash('success' , 'تم حذف العقار بنجاح');
        return redirect()->route('estates.index');
    }

    public function userAdd(){
        return view('user.addEstate')->with('active',40);
    }

    public function userStore(Request $request)
    {
        if(Auth::user())
        {
            $userId = Auth::user()->id;
        }
        else{
            $userId = 0 ;

        }
        $rules = [
            'name'=>'required|min:5|max:100',
            'price'=>'required'  ,
            'area'=>'min:2|max:5',
            'room'=>'required' ,
            'longitude'=>'required' ,
            'latitude'=>'required' ,
            'keywords'=>'min:5|max:200',
            'large_desc'=>'required|min:5|max:160',
            'location'=>'required' ,
            'image'=>'image|required'
        ];
        $customMessages = [
            'name.required' => 'لابد من اضافه اسم العقار' ,
            'price.required' => 'لابد من اضافه سعر العقار' ,
            'area.min' => 'يجب الا تقل المساحه عن 3 احرف ' ,
            'area.max' => 'يجب الا تقل المساحه عن 5 احرف ' ,
            'room.required' => 'لابد من اضافه عدد غرف العقار' ,
            'integer'=>' يجب ادخال اعداد صحيحه فقط ' ,
            'longitude.required'=>'لابد من اضافه خط الطول',
            'latitude.required'=>'لابد من اضافه دائره العرض',
            'keywords.min'=>'يجب الا تقل الكلمات الدلائليه عن 5 احرف',
            'keywords.max'=>'يجب الا تزيد الكلمات الدلائليه عن 200 حرف',
            'min'=>'اقل عدد من الاحرف هو 5 احرف ',
            'large_desc.required'=>'يجب ادخال وصف للعقار ',
            'large_desc.min'=>'لا يمكن ان يقل الوصف عن 10 احرف ' ,
            'location.required'=>'يجب ادخال موقع العقار' ,
            'image.image'=>"امتداد الملف غير مدعم",
            'image.required'=>'يجب ادخال صوره للعقار'

        ];
        $this->validate($request, $rules, $customMessages);
        $image = time().($request->image->getClientOriginalName());
        $request->image->move('uploads/images' , $image);
        $imagePath = 'uploads/images/'.$image ;
        $estate = new Estate();
        $data =$request->all();
        $data['image']=$imagePath;
        $estate->estate_name=$data['name'];
        $estate->estate_price=$data['price'];
        $estate->estate_rent=$data['rent'];
        $estate->estate_area=$data['area'];
        $estate->estate_type=$data['type'];
        $estate->estate_large_desc=$data['large_desc'];
        $estate->estate_keywords=$data['keywords'];
        $estate->estate_longitude=$data['longitude'];
        $estate->estate_latitude=$data['latitude'];
        $estate->estate_location=$data['location'];
        $estate->estate_rooms=$data['room'];
        $estate->estate_image=$data['image'];
        $estate->user_id=$userId   ;
        $estate->save();
        session()->flash('success' , 'تم اضافه العقار بنجاح');
        return view('user.done');

    }
    public function getMyActiveEstates()
    {
        return view('front.index')->with('estates',Estate::where('user_id' , Auth()->user()->id)->where('estate_status',1)->paginate(3))
            ->with('active' , 2);
    }
    public function getMyNonActiveEstates1(){
        return view('front.index')->with('estates',Estate::where('user_id' , Auth()->user()->id)->where('estate_status',0)->paginate(3))
            ->with('active' , 3 );

    }
    public function editMyData1(){
        return view('user.editMyData')->with('user', User::where('id' , Auth::user()->id)->get())->with('active',1);

    }
    public function updateData(Request $request ){

        $rules = [
            'name' => 'string|min:5|max:20',
            'email' => 'string|email|min:5|max:50',

        ];
        $customMessages = [
            'name.string' => ' يجب ان يبدا الاسم بحرف ' ,
            'name.max' => 'اقص عدد حروف للاسم 20 حرف فقط' ,
            'name.min' => 'اقل عدد حروف للاسم 5 احرف ' ,
            'email.string' => 'الاميل يبدا باحرف وليس ارقام' ,
            'email.email'=>' الاميل غير صخيخ ' ,
            'email.min'=>' الاميل غير صخيخ ' ,
            'email.max'=>'الاميل يحتوي علي عدد احرف غير مناسبه',


        ];
        $this->validate($request, $rules, $customMessages);
        $data = $request->only(['name','email']);
        if($request->name == Auth::user()->name)
        {
            $data['name'] = Auth::user()->name ;
        }
       elseif( User::where('name' , $request->name)->first() != null ){
           session()->flash('fail' , 'هذا الاسم متواجد من قبل');
           return redirect()->route('editData');
       }
        else{
           $data['name'] = $request->name ;

        }
        if($request->email == Auth::user()->email)
        {
            $data['email'] = Auth::user()->email ;
        }
        elseif( User::where('email' , $request->email)->first() != null ){
            session()->flash('fail' , 'هذا الاميل متواجد من قبل');
            return redirect()->route('editData');
        }
        else{
            $data['email'] = $request->email ;
        }
        User::where('id' , Auth::user()->id)->update($data);
        session()->flash('success' , 'تم تعديل البيانات بنجاح');
        return redirect()->route('editData');
    }
    public function updatePass(Request $request){
       $data= $request->only(['oldPass','newPass']);


        if (Hash::check($data['oldPass'], Auth::user()->password)) {
            // The passwords match...


            (Auth::user())->update([
                'password'=> Hash::make($data['newPass'])
            ]);

            session()->flash('success' , 'تم تعديل كلمه المرور بنجاح');
            return redirect()->route('editData');
        }
        else{


            // The passwords does not match...
            session()->flash('fail' , 'كلمه المرور القديم خطا');
            return redirect()->route('editData');

        }


    }
    public function editEstate(Estate $estate){
        if(Auth::user()->id == $estate->user_id && $estate->estate_type ==0) // then i own that estate and it does not activated yet
        return view('user.addEstate')->with('estate' , $estate)->with('active',40);
        // else i do not own it or i own it but it activated
        return redirect()->route('index');


    }
    public function updateEstate(Request $request , Estate $estate){
        $rules = [
            'name'=>'min:5|max:100',
            'price'=>'numeric'  ,
            'area'=>'min:3|max:5',
            'room'=>'min:1' ,
            'longitude'=>'min:2' ,
            'latitude'=>'min:2' ,
            'keywords'=>'min:5|max:200',
            'large_desc'=>'min:10',
            'image'=>'image'
        ];

        $customMessages = [
            'name.min' => 'لا يمكن ان يقل اسم العقار عن 5 احرف ' ,
            'name.max' => 'لا يمكن ان يزيد اسم العقار عن 100 حرف ' ,
            'price.numeric' => 'لابد من اضافه سعر العقار' ,
            'area.min' => 'يجب الا يقل عن 3 احرف ' ,
            'area.max' => 'يجب الا يزيد عن 5 احرف ' ,
            'room.min'=>'يجب ادخال عدد الغرف' ,
            'longitude.min'=>'يجب ادخال رقمين علي الاقل',
            'latitude.min'=>'يجب ادخال رقمين علي الاقل',
            'keywords.min'=>'يجب الا تقل الكلمات الدلائليه عن 5 احرف',
            'keywords.max'=>'يجب الا تزيد الكلمات الدلائليه عن 200 حرف',
            'min'=>'اقل عدد من الاحرف هو 5 احرف ',
            'large_desc.min'=>'لا يمكن ان يقل الوصف عن 10 احرف ' ,
            'image.image'=>"امتداد الملف غير مدعم"


        ];
        $this->validate($request, $rules, $customMessages);
        if ($request->has('image'))
        {
            if($estate->estate_image != 'uploads/images/default.jpg' && file_exists($estate->estate_image))
                unlink($estate->estate_image);
            $imageSize = getimagesize($request->image);
            $image = time().($request->image->getClientOriginalName());
            $request->image->move('uploads/images' , $image);
            if($imageSize[0]!=1200 || $imageSize!=800)
            {
                $thumbPath = 'uploads/images/thumbs/'.$image;
                Image::make('uploads/images/'. $image)->resize(1200,800)->save($thumbPath,100) ;
                $imagePath = $thumbPath ;

            }
            else{
                $imagePath = 'uploads/images/'.$image;
            }



        }
        else{
            $imagePath = $estate->estate_image ;

        }


        $estate->update([
            $estate->estate_name=>$request->name ,
            $estate->estate_price=$request->price ,
            $estate->estate_rent=$request->rent ,
            $estate->estate_area=$request->area ,
            $estate->estate_type=$request->type ,
            $estate->estate_large_desc=$request->large_desc ,
            $estate->estate_keywords=$request->keywords ,
            $estate->estate_longitude=$request->longitude,
            $estate->estate_latitude=$request->latitude ,
            $estate->estate_rooms=$request->room ,
            $estate->estate_image=$imagePath

        ]);
        session()->flash('success' , 'تم تعديل العقار بنجاح');
        return redirect()->route('showNonActive');

    }
    public function changeStatus(Estate $estate){
        if($estate->estate_status == 0) {
            $estate->update(['estate_status' => 1]);
            session()->flash('success' , 'تم تفعيل العقار');
        }
        else{
            $estate->update(['estate_status' =>0]);
            session()->flash('success' , 'تم الغاء تفعيل العقار');
        }
        return redirect()->back();

    }
    public function showAllActive(){
        return view('admin.estates.index')->with('estates' , Estate::where('estate_status' ,1 )->get())->with('active' ,'all');

    }
    public function showAllNonActive(){
        return view('admin.estates.index')->with('estates' , Estate::where('estate_status' , 0)->get())->with('active' ,'allNon');

    }



}
