<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index(){
        return view('contactUs')->with('active' , 6);
    }

    public function store(Request $request){
        $rules = [
            'message'=>'required|min:10|max:300',
            'name'=>'required'  , // and text
            'email'=>'required', // end email

        ];
        $customMessages = [
            'message.required' => 'لابد من كتابه محتوي الرساله' ,
            'message.min' => 'اقل عدد 10 احرف' ,
            'message.max' => 'لا يسمح باكثر من 300 حرف' ,
            'message.text' => 'لا يسمح باكثر من 300 حرف' ,
            'name.required' => 'لابد من ادخال الاسم' ,

            'email.required' => 'لابد من اضافه البريد الالكتروني' ,

        ];
        $this->validate($request, $rules, $customMessages);
        Contact::create($request->only(['name','email','subject','message']));

        session()->flash('success','تم تقديم الطلب .. شكرا لك ');
        return redirect()->route('contact-us.index');
    }
}
