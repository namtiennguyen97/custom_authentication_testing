<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $user = User::where('id','=',session('logged'))->first();
        return view('index', compact('user'));
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|max:40',
            'email' => 'required|unique:users',
            'password' => 'required|max:20',
            'reEnterPassword' => 'required|same:password'
        ]);
        $user  = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();
        return response()->json(['Message:','User has been created!'],200);
    }

    public function check(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // validate successfully!
        $user = User::where('email','=',$request->email)->first();
        if ($user){
            if (Hash::check($request->password,$user->password)){
                $request->session()->put('logged',$user->id);
//                return redirect()->route('index');
                return response()->json(['Success','You has been logged'],200);
            }
            else{
                return response()->json(['Error','Account not found!'],409);
            }
        }else{
            return response()->json(['message' => 'No user match!'],401);
        }
    }

    public function userProfile(){
        if (session()->has('logged')){
            $user = User::where('id','=',session('logged'))->first();
//            $data = [
//              'userLogged' => $user
//            ];
        }
        return view('userProfile',compact('user'));
    }
    public function logout(){
        if (session()->has('logged')){
            session()->pull('logged');
            return redirect()->route('index');
        }
    }
    // user dashboard

}
