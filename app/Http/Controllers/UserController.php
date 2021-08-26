<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    // public function editProfile(Request $request){
    //     // return $request;
    //     $user = Auth::user();
    //     $msg = "";
    //     return Auth()->user();


    //     $user->email = $request->email;
    //     $msg .= " ";
    //     $user->name = $request->name;
    //     $msg .= "Updated Email, Updated Name ";

    //     if($request->password != ''){
    //         if($request->repeat == $request->password){
    //             $user->password = Hash::make($request->password);    
    //             $msg .= "and Password";
    //         }
    //     }
    //     $user->save();
    //     return ['message' => 'profile Updated'];
    //     return view('dashboard',compact('msg'));
    // }

    public function editProfile(Request $request){
        $user = User::find($request->id);
        if($request->has('name')){
            $user->name = $request->name;
        }
        if($request->has('email')){
            $user->email = $request->email;
        }
        if($request->has('password')){
            $user->password = Hash::make($request->password);    
        }
        $user->save();
        return ['message' => 'profile Updated'];
        // return $user;
    }
}
