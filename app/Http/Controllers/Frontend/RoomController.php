<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Models\booking;
use App\Models\room;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Carbon\Carbon;
class RoomController extends Controller
{
    public function all_room(){

        $guestToken = Str::random(60);
        Cache::put('guest_token_' . $guestToken, true, now()->addHours(2)); // Expires in 2 hours

        $room = room::orderby('id','desc')->get();

        return view('frontend.home',['token' => $guestToken, 'room' => $room ]);
    }

    public function room_detail($id ){

        $room = room::where('id',$id)->first();

        if(!empty($room)){
            $booking_today = booking::where('date', today())
            ->orderBy('start_time', 'asc')
            ->orderBy('end_time', 'asc')
            ->where('room_id',$room->id)
            // ->where('end_time','>',\Carbon\Carbon::now('Asia/Jakarta')->format('h:i A'))
            ->where('status', 1)
            ->get();
        }

        $booking_data = booking::orderBy('date', 'asc')
            ->orderBy('start_time', 'asc')
            ->where(function ($query) {
                $query->whereMonth('date', Carbon::now()->month) // Current month
                      ->orWhereMonth('date', Carbon::now()->addMonth()->month); // Next month
            })
            ->where('room_id', $room->id)
            ->where('status', 1)
            ->get();




        // return $room_name;
        $last_booking = count( $booking_today );

        return view('frontend.room-detial',[
            'booking_today'=> $booking_today,
            'last'=>$last_booking,
            'booking_data' => $booking_data,
            'room' => $room
        ]);


    }
    public function room_detail_by_meeting_id( $id ,$meeting_id){
        $room = room::where('id',$id)->first();

        if(!empty($room)){
            $booking_today = booking::where('date', today())
            ->orderBy('start_time', 'asc')
            ->orderBy('end_time', 'asc')
            ->where('room_id',$room->id)
            // ->where('end_time','>',\Carbon\Carbon::now('Asia/Jakarta')->format('h:i A'))
            ->where('status', 1)
            ->get();
        }

        $booking_data = booking::orderBy('date', 'asc')
            ->orderBy('start_time', 'asc')
            ->where(function ($query) {
                $query->whereMonth('date', Carbon::now()->month) // Current month
                      ->orWhereMonth('date', Carbon::now()->addMonth()->month); // Next month
            })
            ->where('room_id', $room->id)
            ->where('status', 1)
            ->get();




        // return $room_name;
        $last_booking = count( $booking_today );

        return view('frontend.room-detial',[
            'booking_today'=> $booking_today,
            'last'=>$last_booking,
            'booking_data' => $booking_data,
            'room' => $room,
            'meeting_id' => $meeting_id
        ]);


    }
    public function add_room(){

        return view('frontend.create-room');
    }
    public function create_room_submit(request $request){

        $file = $request->file('thumbnail');
        $thumbnail = $this->upload_file($file);

        $room = new room();
        $room->room_name = $request->room_name;
        $room->description = $request->description;
        $room->seat = $request->seat;
        $room->thumbnail = $thumbnail;
        $room->Created_by = Auth::user()->name;
        $stored = $room->save();

        if($stored){
            return redirect('/')->with('success','Create Room success.');
        }else{
            return redirect('/')->with('fail','Opps. Operation error');
        }
    }

    public function update_room_submit(request $request){
        $id = $request->id;

        $room = room::where('id',$id)->first();
        if($request->thumbnail != null){
            $file = $request->file('thumbnail');
            $thumbnail = $this->upload_file($file);
            $room->thumbnail =$thumbnail;
        }
        $room->room_name = $request->name??'';
        $room->seat = $request->seat??0;
        $room->description = $request->description??'';
        $stored = $room->save();

        if($stored){
            return redirect('/room/list')->with('success','Update Success.');
        }else{
            return redirect('/room/list')->with('fail','Update fail.');
        }
    }
    public function delete_room_submit(request $request){
        $id = $request->id;
        $room = room::where('id',$id)->first();

        $deleted = $room->delete();
        if($deleted){
            return redirect('/room/list')->with('success','Delete Success.');
        }else{
            return redirect('/room/list')->with('fail','Delete fail.');
        }
    }
    public function list_room(){
        $room = room::orderby('id', 'desc')->get();

        return view('frontend.list-room',['room' => $room ]);
    }


}
