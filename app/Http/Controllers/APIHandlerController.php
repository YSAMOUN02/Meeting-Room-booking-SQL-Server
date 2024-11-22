<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\booking;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mail_data;
class APIHandlerController extends Controller
{


    public function login_submit(Request $request)
    {
        // Get input data from the request
        $name_email = $request->name_email;
        $password = $request->password ?? '';  // Default to empty string if no password is provided
        $remember = $request->remember ?? false;

        // Log input data for debugging
        \Log::info('Login Attempt:', [
            'name_email' => $name_email,
            'password' => $password,
            'remember' => $remember,
        ]);

        // Check if the password is present and handle accordingly
        if (empty($password)) {
            \Log::error('Password field is empty');
            return response()->json(['error' => 'Password is required'], 400);
        }

        // First, attempt to log in using user_login and password
        if (Auth::attempt(['user_login' => $name_email, 'password' => $password], $remember)) {
            $user = Auth::user();
            $token = $user->createToken('MyAppToken')->plainTextToken;

            return response()->json([
                'success' => 'Login Success with User Login.',
                'token' => $token,
                'user' => $user,
            ], 200);
        }

        // If login with user_login failed, attempt to log in using email and password
        elseif (Auth::attempt(['email' => $name_email, 'password' => $password], $remember)) {
            $user = Auth::user();
            $token = $user->createToken('MyAppToken')->plainTextToken;

            return response()->json([
                'success' => 'Login Success with Email.',
                'token' => $token,
                'user' => $user,
            ], 200);
        }
        // If all attempts fail, return an error message
        return response()->json(['error' => 'Invalid credentials'], 401);
    }


    public function checking_existing_room(Request $request){
        try {


        $start_date = $request->start_date??'NA';
        $end_date  = $request->end_date??'NA';
        $start_time = $request->start_time??'NA';
        $end_time = $request->end_time??'NA';
        $qty_date  =1;
        $message = '';
        $bookable = 0;

        $from_date = new \DateTime($start_date);
        $to_date = new \DateTime($end_date);
        $to_date->modify('+1 day'); // Include the end date in the range
        // Calculate Date
        $period = new \DatePeriod(
            $from_date,
            new \DateInterval('P1D'), // Interval of 1 day
            $to_date
        );

        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d'); // Format each date as a string (e.g., "2024-11-06")
        }

        if($start_date != 'NA' && $end_date != 'NA' && $start_time != 'NA'  && $end_time != 'NA'){



            $qty_date = count($dates);
            if($qty_date == 1){

                $date = new \DateTime($dates[0]);
                $exist_booked = Booking::where('date',$date )
                ->where('room_id',$request->room)
                ->where('status',1)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                          ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                          ->orWhere(function ($query) use ($request) {
                              $query->where('start_time', '<=', $request->start_time)
                                    ->where('end_time', '>=', $request->end_time);
                          });
                })
                ->get();


                if(!empty($exist_booked)){

                    $state_data  = 0;
                    foreach($exist_booked as $item ){

                        $message.= '- Time '.\Carbon\Carbon::parse($item->start_time)->format('h:i A'). ' to '.\Carbon\Carbon::parse($item->end_time)->format('h:i A').' has been booked by '. $item->department.'  Topic: '.$item->title.'<br>';
                        $state_data ++;
                    }
                    if($state_data  == 0){
                     // Return Null Message
                     $message = 'Room is bookalbe.';
                     $bookable = 1;
                    }
                }
                else{
                  // Return Null Message
                  $message = 'Room is bookalbe.';
                  $bookable = 1;
                }
            }elseif($qty_date > 1){
                $loop_bookable = 0;
                for ($i = 0; $i < $qty_date; $i++) {
                    $formattedDate = Carbon::createFromFormat('Y-m-d', $dates[$i])->format('Y-m-d');


                    $date = new \DateTime($dates[$i]);
                    $exist_booked = Booking::where('date', $date)
                    ->where('room_id', $request->room)
                    ->where('status',1)
                    ->where(function ($query) use ($request) {
                        $query->where('start_time', '<', $request->end_time)
                            ->where('end_time', '>', $request->start_time);
                    })
                    ->get();


                    if ($exist_booked->isNotEmpty()) { // Check if there are existing bookings
                        foreach ($exist_booked as $item) {
                            $message .= '- Date: ' . $date->format('d-m-Y') . ' | Time: ' .
                                \Carbon\Carbon::parse($item->start_time)->format('h:i A') . ' to ' .
                                \Carbon\Carbon::parse($item->end_time)->format('h:i A') . ' has been booked by ' .
                                $item->department . ' | Topic: ' . $item->title . '<br>';
                                $loop_bookable = 1;
                        }
                    }
                }
                if($loop_bookable == 0){
                    $message = 'Room is bookalbe.';
                    $bookable = 1;
                }

            }else{
                $message = 'Date is 0 Day.';
                $bookable = 0;
            }


            return response()->json([
                'message'=>$message,'bookable'=>$bookable
            ],200);
        }else{
            $message = 'Error Date Invalid.';
            return response()->json([$message,$bookable],200);
        }

       } catch (\Exception $e) {
        // Log any errors with more details

        return response()->json(['error' => 'Invalid time format'], 500);
    }

    }
    public function check_name_for_reset_password(Request $request){
        $name_email = $request->name_email;

        $count = 0;
        $user = User::where('user_login',$name_email)->first();


        if(empty($user)){
            $user = User::where('email',$name_email)->first();
        }


        if(empty($user)){

            return response()->json(["Invalid Name or Email."], 200 );
        }else{

            $temp_password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
            $user->password =  Hash::make($temp_password);
            $user->save();




            $mailData = [
                'fullName' => $user->name,
                'company' => $user->company,
                'department' => $user->department,
                'email' => $user->email,
                'temp_password' => $temp_password,
                'phone' => $user->phone,
                'url' => url('/forgot/password/via/'.$user->user_login).'/'.$temp_password // Generate full URL for the forgot password page
            ];
            $data = new arr();
            $data->message = "Code has sent to email:  ".$user->email.'  Check your Inbox to recieve Code.';
            $data->status = 'success';


            Mail::to($user->email)->send(new Mail_data($mailData));
            // return response()->json([123], 200);
            return response()->json( $data, 200);
        }


    }

    public function search_user(request $request){
        $type = $request->type??'NA';
        $value = $request->value??'NA';
        $page = $request->page??1;
        $limit = 30;

        $count = 0;

        $user =  User::orderby('id','desc');
        $count_all = $user->count();

        $offet = 0;
        if($page != 0){
            $offet = ($page - 1) * $limit;
        }

        $total_pages = ceil( $count_all/$limit);

        if($type != 'NA' && $value != 'NA'){
            $user->where($type,'LIKE','%'.$value.'%');
        }
        $user->offset($offet);
        $user->limit($limit);
        $datas = $user->get();

        $data = new arr_obj();
        $data->page = $page;
        $data->total_page = $total_pages;
        $data->total_record = $count_all;
        $data->data = $datas;

        $count = count($datas);
        if($count > 0){
            return response()->json($data, 200, );
        }else{
            return response()->json([], 200, );
        }

    }
}
class arr{
    public $message;
    public $status;
}
class arr_obj {
    public $page;
    public $total_page;
    public $total_record;
    public $data;

}
