<?php

namespace App\Http\Controllers;

use App\Estate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SingleEstateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.index')->with('estates' ,Estate::where('estate_status',1)->orderBy('id','desc')->paginate(3))
            ->with('active' ,4);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Estate $estate)
    {


        $with_same_rent = Estate::where('estate_rent',$estate->estate_rent)->where('id' ,'!=', $estate->id)->orderBy(DB::raw('RAND()'))->take(3)->get();
        $with_same_type = Estate::where('estate_type',$estate->estate_type)->where('id' ,'!=', $estate->id)->orderBy(DB::raw("RAND()"))->take(3)->get();
       return view('front.single' , compact(['estate','with_same_rent','with_same_type']))->with('active',5);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function forRent(){
        return view('front.index')->with('estates' ,Estate::where('estate_status',1)->where('estate_rent',0)->orderBy('id','desc')->paginate(3))
            ->with('active' , 8);





    }
    public function forBuy(){
        return view('front.index')->with('estates' ,Estate::where('estate_status',1)->where('estate_rent',1)->orderBy('id','desc')->paginate(3))
            ->with('active' ,9);

    }
    public function showByType($type){
        if(in_array($type,['0','1','2'])) {

            if($type == 0)
            {
                $active = 10 ;
            }
            elseif ($type == 1){
                $active = 11 ;

            }
            else{
                $active = 12 ;
            }

            return view('front.index')->with('estates', Estate::where('estate_status', 1)->where('estate_type', $type)->orderBy('id', 'desc')->paginate(3))
                ->with('active', $active);
        }
        else
            return redirect()->back();
    }
    public function search(Request $request){
$max_price = ($request->estate_price_to==null) ? DB::select('select max(estate_price) as max_price from `estates` ')[0]->max_price:$request->estate_price_to ;
$min_price =($request->estate_price_from==null) ? DB::select('select min(estate_price) as min_price from `estates`')[0]->min_price: $request->estate_price_from ;


    $query = DB::table('estates')->select("*")->where('estate_status',1);
        $searched= [] ;
     foreach ($request->except(['_token','_method','page']) as $key=>$req)
     {
         if($req != null)
         {
             if($key == 'estate_price_from' || $key =='estate_price_to')
             {
                  $query->where('estate_price' , '>=', $min_price)->where('estate_price','<=' ,$max_price);

             }
           else {
               $query->where($key, $req);
           }
             $searched[$key]=$req;
         }
     }

     if($request->estate_type == 0)
         $active = 10 ;
     elseif($request->estate_type ==1)
         $active = 11 ;
     else $active = 12 ;
//        follows method
//     $query = "select * from Estates $out";
       return view('front.index')->with('estates' , $query->paginate(1))
           ->with('searched',$searched)->with('active',$active);

    }

}
