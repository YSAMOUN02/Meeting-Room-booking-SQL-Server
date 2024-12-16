<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\booking;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Carbon\Carbon;
use App\Models\room;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\alert;
use App\Mail\alert_self_cancel;

use Illuminate\Support\Facades\DB;
class bookingRoomController extends Controller
{
    public function new_booking(Request $request)
    {
        $exist_booked_room = 0;

        $from_date = new \DateTime($request->from_date);
        $to_date = new \DateTime($request->to_date);
        $to_date->modify('+1 day'); // Include the end date in the range

        $period = new \DatePeriod(
            $from_date,
            new \DateInterval('P1D'), // Interval of 1 day
            $to_date
        );
        $state_success = 0;
        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d'); // Format each date as a string (e.g., "2024-11-06")
        }

        $qty_date = count($dates);

        $message = '';

        if($qty_date == 1){

            $date = new \DateTime($dates[0]);
                $room = new Booking();
                $room->room_id = $request->room??'';
                $room->room = $request->ka ?? '';
                $room->staff_name = $request->staff_name ?? '';
                $room->staff_id = $request->staff_id ?? '';
                $room->department = $request->staff_department ?? '';
                $room->title = $request->description ?? '';
                $room->meeting_type = $request->meeting_type ?? '';
                $room->date = $dates[0]; // Set the current date in the loop
                $room->start_time = $request->start_time ?? '';
                $room->end_time = $request->end_time ?? '';
                $room->created_by_id = Auth::user()->id;
                $room->created_by_name = Auth::user()->name;
                $stored = $stored = $room->save();
            if($stored){
                $state_success++;
            }

        }elseif($qty_date > 1){

            // return  $current_date ;
            for ($i = 0; $i < $qty_date; $i++) {

                $date = new \DateTime($dates[$i]);


                    $from_date = new \DateTime($request->from_date);
                    $to_date = new \DateTime($request->to_date);

                    $interval = $from_date->diff($to_date);
                    $qty_date = $interval->days;

                    $current_date = clone $from_date; // Clone to keep original date intact

                    for ($i = 0; $i <= $qty_date; $i++) {
                        $room = new Booking();
                        $room->room_id = $request->room??'';
                        $room->room = $request->ka ?? '';
                        $room->staff_name = $request->staff_name ?? '';
                        $room->staff_id = $request->staff_id ?? '';
                        $room->department = $request->staff_department ?? '';
                        $room->title = $request->description ?? '';
                        $room->meeting_type = $request->meeting_type ?? '';
                        $room->date = $current_date->format('Y-m-d'); // Set the current date in the loop
                        $room->start_time = $request->start_time ?? '';
                        $room->end_time = $request->end_time ?? '';
                        $room->created_by_id = Auth::user()->id;
                        $room->created_by_name = Auth::user()->name;
                        $stored = $stored = $room->save();


                        // Move to the next day
                        $current_date->modify('+1 day');

                        if($stored){
                            $state_success++;
                        }
                }
            }

        }else{
            $message = 'Date is 0 Day.';
        }
        if($state_success == $qty_date){
                return redirect('/room/detail/'.$request->room)->with('success','Booking Success.');
        }else{
            return redirect('/room/detail/'.$request->room)->with('success','Booking Success.');
        }
        // }
    }


    public function room()
    {

        return view('frontend.room-detial');

    }


    public function booked_room(){
        // $current_time =    \Carbon\Carbon::parse(today())->format('h:i A') ;


        $data = booking::where('date', '>=', today())
            ->orderBy(DB::raw('CAST(date AS DATE)'), 'asc') // Order by the `date` column as DATE
            ->orderBy('id', 'desc') // Secondary order by ID, descending
            ->get();

        $current_time = \Carbon\Carbon::now('Asia/Jakarta')->format('h:i A');
        $current_date = today();
        // return $data;
        return view('frontend.list-booked-room',['data'=>$data
    , 'current_time' =>$current_time,
        'current_date' =>$current_date
]);
    }
    public function booked_room_history($page){

                $sql = booking::orderby('id','desc');

                $count_post = $sql->count();

                $limit = 100;

                $total_page = ceil($count_post/$limit);

                $offset = 0;
                if($page != 0){
                    $offset = ($page - 1) * $limit;
                }
                $sql->limit($limit);
                $sql->offset($offset);

                $data = $sql->get();



                $current_time = \Carbon\Carbon::now('Asia/Jakarta')->format('h:i A');
                $current_date = today();
                return view('frontend.list-booking-history',[
                    'data'=>$data,
                    'current_date' =>$current_date,
                    'total_page' => $total_page,
                    'total_record' => $count_post,
                    'page' => $page
                ]);
    }


    public function cancel_booking(request $request){
       $id = $request->id;
        $reason = $request->reason;
        $now = today();


        $meeting = booking::where('id',$id)->first();
        $meeting->status = 0;
        $meeting->cancel_by_name = Auth::user()->name;
        $meeting->cancel_reason =  $reason;
        $meeting->cancel_date =  $now ;
        $save =   $meeting->save();

        $canceler = Auth::user()->name;

        $book_data_owner = User::where('id', $meeting->created_by_id)->first();




        // state 0 is when other user cancel
        $state = 0;

        if($book_data_owner->id == Auth::user()->id ){
            $state = 1;
        }

        $mailData = [
            'state' => $state,
            'fullName' => $meeting->staff_name,
            'room' => $meeting->room,
            'topic' => $meeting->title,
            'canceler' =>  $canceler,
            'reason' => $reason,
            'cancel_date' => $now,
            'url' => 'http://192.168.1.71:8700/login'// Generate full URL for the forgot password page
        ];

        if($state == 0){
            Mail::to($book_data_owner->email)->send(new alert($mailData));
        }else{
            Mail::to($book_data_owner->email)->send(new alert_self_cancel($mailData));

        }


        if($save){
            return redirect('/list/room/booked')->with('success','Canceled Room Success.');
        }else{
            return redirect('/list/room/booked')->with('fail','Opps! Something went wronge.');
        }

    }
}
