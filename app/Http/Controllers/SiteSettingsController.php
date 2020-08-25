<?php

namespace App\Http\Controllers;

use App\Estate;
use App\Sitesetting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SiteSettingsController extends Controller
{
    public function index()
    {
        return view('setting.index')->with('settings', Sitesetting::all());
    }

    public function store(Request $request)
    {
        foreach ($request->except(['__token']) as $key => $val) {

//            echo $key ." => "  .$val ;
            if ($key=='mainBackGround') {
                $image = uploadImage($val);
                if(!$image){
                    session()->flash('success', 'مقاسات الصوره غير مناسبه .. اقصى ارتفاع 500 اقصى عرض 1600');
                    return redirect()->route('setting.index');
                }
            }
            else{
               Sitesetting::where('settingName', $key)->update(['value' =>$val]);
            }
//        dd($request->all());                  name=siteName value='' ,, name=value  value=''
        }
        session()->flash('success', 'تم اضافه اعدادات الموقع بنجاح');
        return redirect()->route('setting.index');


    }
}
