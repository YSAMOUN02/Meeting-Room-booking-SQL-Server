<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
// use App\Mail\Mail_data;
use App\Mail\register_mail;
use App\Models\booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{


    public function login()
    {

        return view('frontend.login');
    }

    public function login_submit(request $request)
    {

        $name_email = $request->input('name_email');
        $password = $request->password;
        $remember = $request->remember;


        if (Auth::attempt(['user_login' => $name_email, 'password' => $password], $remember)) {
            // if(Auth::user()->status == 0){
            //     Auth::logout();

            //         return redirect("/login")->with('fail','Your user has been disable from System.');

            // }

            return redirect('/')->with('success', 'Login Success.');
        } elseif (Auth::attempt(['email' => $name_email, 'password' => $password], $remember)) {
            // if(Auth::user()->status == 0){
            //     Auth::logout();

            //         return redirect("/")->with('fail','Your user has been disable from System.');

            // }

            return redirect('/')->with('success', 'Login Success.');
        } else {
            return redirect('/')->with('fail', 'Invalid Credential.');
        }
    }

    public function logout()
    {
        $s =  Auth::logout();


        return redirect('/')->with('success', 'Logout Success.');
    }

    public function forgot_password()
    {
        $username = '';
        $code = '';
        return view('frontend.forgot-password', ['username' => $username, 'code' => $code]);
    }
    public function forgot_password_with_user($username, $code)
    {

        return view('frontend.forgot-password', ['username' => $username, 'code' => $code]);
    }


    public function dashboard($year)
    {
        // ---------------------------------------------------------Global Usage------------------------------------------
        // Use current year and month if not provided
        $year = $year ?? Carbon::now()->year;
        $month = $month ?? Carbon::now()->month;



        // Get distinct years that have bookings
        $years_exist = Booking::select(DB::raw('YEAR(created_at) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');





        // Get all rooms from Booking
        $rooms = booking::pluck('room')->unique();

        $months_label = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $chartData = [];

        foreach ($rooms as $roomName) {

            $monthlyCount = [];

            for ($m = 1; $m <= 12; $m++) {
                $count = Booking::where('room', $roomName)
                    ->whereYear('date', $year)
                    ->whereMonth('date', $m)
                    ->orderby('room', 'desc')
                    ->where('status', 1)
                    ->count();

                $monthlyCount[] = $count;
            }

            $chartData[] = [
                'room' => $roomName,
                'data' => $monthlyCount,
            ];
        }









        // Get all departments that have bookings in the selected year
        $departments = Booking::select('department')
            ->whereYear('date', $year)
            ->where('status', 1)
            ->distinct()
            ->pluck('department');

        // Prepare chart data for departments
        $departmentChartData = [];

        foreach ($departments as $dept) {
            $count = Booking::where('department', $dept)
                ->whereYear('date', $year)
                ->where('status', 1)
                ->count();

            $departmentChartData[] = [
                'department' => $dept,
                'total' => $count,
            ];
        }




        return view('frontend.dashboard', [
            'month' => $month,
            'year' => $year,
            'rooms' => $rooms,
            'years_exist' => $years_exist,
            'chartData' => $chartData,
            'months_label' => $months_label,

            'departmentChartData' => $departmentChartData,
        ]);
    }
}
class arr
{
    public $message;
    public $status;
}
