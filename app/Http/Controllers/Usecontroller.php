<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Usecontroller extends Controller
{
    //
    public function create(Request $request){

     $createUser=User::create([
        'fname'=>$request->fname,
        'lname'=>$request->lname,
        'Type'=>$request->Type,
        'phone'=>$request->phone,
        'email'=>$request->email,
        'password'=>Hash::make($request->password)



    ]);
     if($createUser)
     {
        $sweet=array('title'=>'User Created successfully','message'=>'Your User is Created');
	    return redirect()->back()->with('sweet',$sweet);
     }
    }
    public function show(){
        $users=User::Where('Type','!=','Admin')->get();
        return view('admin.showusers',compact('users'));

    }
}
