<?php

namespace App\Http\Controllers;

use App\Http\Requests\createUserRequest;
use App\Http\Requests\updateUserRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.users.index')->with('users' , User::paginate(3));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createUserRequest $request)
    {
        $data = $request->all();
        $data['password']=Hash::make($request->password);
        User::create($data);
        session()->flash('success' , 'تم اضافه العضو بنجاح');
        return redirect()->route('users.index');
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
    public function edit(User $user)
    {
        $hisNonActive= $user->estates()->where('estate_status',0)->paginate(7) ;
        if($hisNonActive->count() == 0)
            $hisNonActive = 0;
        $hisActive= $user->estates()->where('estate_status',1)->paginate(7) ;
        if($hisActive->count() == 0)
            $hisActive = 0;

        return view('admin.users.create')->with('user' , $user)
            ->with('hisNonActive',$hisNonActive)->with('hisActive',$hisActive);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateUserRequest $request,User $user)
    {
        $data = $request->all();
        if($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        session()->flash('success' , 'User Updated Successfully');
        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->role=='user')
        {
            $estates = $user->Estates() ;
            if ($estates->count()>0)
            {
                $estates->delete();
            }
            $user->delete();
            session()->flash('success' , 'تم حذف العضو بنجاح');
            return redirect()->route('users.index');
        }

    }
}
