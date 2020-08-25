<?php

use App\Sitesetting;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;


function getSetting($settingName){
 return Sitesetting::where('settingName',$settingName)->first()['value'];
}
function getUnreadMessages(){
    return App\Contact::where('view','0')->get();

}

function getOnly3UnreadMessages(){
    return App\Contact::where('view','0')->take(3)->get();

}

function countUnreadMessages(){

    return App\Contact::where('view','0')->count() ;

}
function contact(){
    return[
      '1'=>'اعجاب',
      '2'=>'خدمه عامه',
      '3'=>'اقترحات',
      '4'=>'دعم منتج'
    ];
}
 function roomNumber():array {
    for ($i=2 ; $i<=40 ; $i++)
        $room[$i]=$i ;
    return  $room;

}
function getTheType():array {
    $type = ['شقه','فيلا','شاليه'];
return $type;

}

function getRent():array {
    $rent = ['ايجار','تمليك'];
    return $rent ;

}
function getLocations()
{
    return [
        "5" => "اسوان",
        "6" => "اسيوط",
        "4" => "الاسكندرية",
        "13" => "الاسماعيلية",
        "15" => "الاقصر",
        "24" => "البحر الاحمر",
        "7" => "البحيرة",
        "2" => "الجيزة",
        "9" => "الدقهلية",
        "28" => "السويس",
        "25" => "الشرقية",
        "12" => "الغربية",
        "11" => "الفيوم",
        "1" => "القاهرة",
        "22" => "القليوبية",
        "18" => "المنوفية",
        "17" => "المنيا",
        "19" => "الوادي الجديد",
        "8" => "بني سويف",
        "21" => "بور سعيد",
        "27" => "جنوب سيناء",
        "3" => "حلوان",
        "10" => "دمياط",
        "26" => "سوهاج",
        "20" => "شمال سيناء",
        "23" => "قنا",
        "14" => "كفر الشيخ",
        "16" => "مرسي مطروح",

    ];

}
function getValue(){
    return [
        'estate_price'=> 'سعر العقار',
        'estate_location'=> 'موقع العقار',
        'estate_rooms'=> 'عدد الغرف',
        'estate_type'=> 'نوع العقار',
        'estate_rent'=> 'نوع العمليه',
        'estate_area'=> 'مساحه العقار' ,
        'estate_price_from'=>'السعر من' ,
        'estate_price_to'=>'السعر الي'

    ];
}
function uploadImage( UploadedFile $image )
{
    $imageSize = getimagesize($image);
//    $width = $imageSize[0] ;
//    $height = $imageSize[1] ;
//    if ($imageSize[0] > 1600 || $imageSize[1] > 500)
//    {
//        return false;
//    }


        if (Sitesetting::where('settingName', 'mainBackGround')->first()['value'] != null) {
            if (file_exists(Sitesetting::where('settingName', 'mainBackGround')->first()['value'])) {
                unlink(Sitesetting::where('settingName', 'mainBackGround')->first()['value']);
            }
        }
        $imageName = time() . ($image->getClientOriginalName());
        $image->move('uploads/images', $imageName);
        $imagePath = 'uploads/images/' . $imageName;
    if($imageSize[0]!=1200 || $imageSize!=800)
    {
        Image::make('uploads/images/'. $imageName)->resize(1200,800)->save($imageName,100) ;
    }
        $settings = new Sitesetting();
        Sitesetting::where('settingName', 'mainBackGround')->update(['value' => $imagePath]);
     return true ;

}


