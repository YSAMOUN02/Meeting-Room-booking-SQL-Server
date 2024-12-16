<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
// use App\Mail\Mail_data;
use App\Mail\register_mail;
use Illuminate\Support\Facades\Mail;

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

            return redirect('/')->with('success','Login Success.');
        }
        elseif(Auth::attempt(['email' => $name_email , 'password' => $password],$remember)){
            // if(Auth::user()->status == 0){
            //     Auth::logout();

            //         return redirect("/")->with('fail','Your user has been disable from System.');

            // }

            return redirect('/')->with('success','Login Success.');
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


    // public function register_mail(){
    //     $users = User::orderby('id','desc')
    //     ->where(function ($query)  {
    //         $query->where('id',105)
    //         ->orwhere('id',106)
    //         ->orwhere('id',107)
    //         ->orwhere('id',108);
    //         })
    //     ->get();





    //         // return $users;
    //     foreach($users as $user){
    //         $update_user = User::where('id',$user->id)->first();
    //         $temp_password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);

    //         $update_user->password =  Hash::make($temp_password);
    //         $update_user->save();

    //         $mailData = [
    //             'fullName' => $user->name,
    //             'user_login' => $user->user_login,
    //             'company' => $user->company,
    //             'department' => $user->department,
    //             'email' => $user->email,
    //             'temp_password' => $temp_password,
    //             'phone' => $user->phone,
    //             'url' => 'http://192.168.1.71:8700/forgot/password/via/'.$user->user_login.'/'.$temp_password // Generate full URL for the forgot password page
    //         ];
    //         $data = new arr();
    //         $data->message = "Code has sent to email:  ".$user->email.' within 2-3 minute Check your Inbox to recieve new register.';

    //         $send = Mail::to($user->email)->send(new register_mail($mailData));
    //     }


    //     // return  $user;
    //     // if($send){
    //     //     return redirect('/')->with('success','Send success.');
    //     // }else{

    //     //     return redirect('/')->with('fail','Send fail.');
    //     // }


    // }
}
class arr{
    public $message;
    public $status;
}
