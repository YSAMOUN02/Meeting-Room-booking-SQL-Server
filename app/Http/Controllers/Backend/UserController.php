<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function create_user_form(){
        return view('frontend.create-user');
    }

    public function create_user_submit(request $request){

        $name = $request->first_name.' '.$request->last_name;

        $user = new User();

        $user->name = $name;
        $user->email = $request->email??'';

        $user->password = Hash::make($request->password)??'';

        $user->phone = $request->phone??'';
        $user->role = $request->role??'';
        $user->company = $request->company??'';
        $user->department = $request->department??'';
        $user->user_login = $request->user_login??'';
        $user->id_card = $request->id_card??'';

        $stored = $user->save();

        if($stored){
            return redirect('/list/user')->with('success','Create User Success.');
        }else{
            return redirect('/list/user')->with('fail','Opp! Operation Fail.');
        }
    }


    public function list_user(){
        $user =  User::orderby('id','desc')->get();
        return view('frontend.list-user',['user' => $user]);
    }

    public function delete_user_submit(request $request){
        $id = $request->id;
        $User = user::where('id',$id)->first();
        $delete = $User->delete();

        if($delete){
            return redirect('/list/user')->with('success','Delete User Success.');
        }else{
            return redirect('/list/user')->with('fail','Opp! Operation Fail.');
        }
    }

    public function update_user(request $request){

        $user =  User::where('id',$request->id)->first();

        $user->name = $request->name;
        $user->email = $request->email??'';
        if($request->password != ''){
        $user->password = Hash::make($request->password)??'';
        }
        $user->phone = $request->phone??'';
        $user->role = $request->role??'';
        $user->company = $request->company??'';
        $user->department = $request->department??'';
        $user->user_login = $request->user_login??'';
        $user->id_card = $request->id_card??'';

        $stored = $user->save();
        if(Auth::user()->id == $request->id){
            Auth::logout();
            return redirect('/')->with('success','Your User has been change please login again.');
        }

        if($stored){
            return redirect('/list/user')->with('success','Create User Success.');
        }else{
            return redirect('/list/user')->with('fail','Opp! Operation Fail.');
        }
    }

    public function my_profile(){
        if(!empty(Auth::user())){
            $user = Auth::user();
        }else{
            return redirect("/")->with('fail','No Permission');
        }


        return view('frontend.profile-user',['user' => $user]);
    }

    public function update_user_profile(request $request){
        $user =  User::where('id',$request->id)->first();
        $user->password = Hash::make($request->password)??'';
        $user->user_login = $request->user_login??'';
        $stored = $user->save();

        if($stored){
            return redirect('/')->with('success','Updated User Success.');
        }else{
            return redirect('/')->with('fail','Opp! Operation Fail.');
        }
    }
}
