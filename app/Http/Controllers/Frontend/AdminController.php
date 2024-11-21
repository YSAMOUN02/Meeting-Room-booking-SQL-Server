<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{


    public function login(){

        return view('frontend.login');
    }

    public function login_submit(request $request){

        $name_email = $request->input('name_email');
        $password = $request->password;
        $remember = $request->remember;


        if(Auth::attempt(['user_login' => $name_email, 'password' => $password],$remember)){
                // if(Auth::user()->status == 0){
                //     Auth::logout();

                //         return redirect("/login")->with('fail','Your user has been disable from System.');

                // }

            return redirect('/room')->with('success','Login Success.');
        }
        elseif(Auth::attempt(['email' => $name_email , 'password' => $password],$remember)){
            // if(Auth::user()->status == 0){
            //     Auth::logout();

            //         return redirect("/")->with('fail','Your user has been disable from System.');

            // }

            return redirect('/room')->with('success','Login Success.');
        }else{
            return redirect('/')->with('fail','Invalid Credential.');
        }
    }

    public function logout(){
      $s =  Auth::logout();


        return redirect('/')->with('success','Logout Success.');

    }

    public function forgot_password(){
        $username = '';
        $code='';
        return view('frontend.forgot-password',['username' => $username, 'code'=> $code]);
    }
    public function forgot_password_with_user($username,$code){

        return view('frontend.forgot-password',['username' => $username, 'code'=> $code]);
    }
}

