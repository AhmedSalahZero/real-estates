<?php

namespace App\Http\Controllers;

use App\Estate;

use App\User;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function index(){


        $latestEstates = Estate::orderBy('created_at' , 'desc')->take(5)->get();
        $latestUsers = User::orderBy('created_at' ,'desc')->take(8)->get();


        return view('admin.index',compact(['latestEstates' , 'latestUsers']));

    }





}
