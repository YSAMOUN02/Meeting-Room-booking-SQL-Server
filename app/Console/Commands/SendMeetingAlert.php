<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\booking;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\alert_upcoming_booking;



class SendMeetingAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alert:meetings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email alerts for upcoming meetings';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // \Log::info('AlertMeetings command triggered.');


        // Get meetings happening within the next 30 minutes
        $upcomingMeetings = booking::where('date', today())
        ->where('alerted', 0)
        ->whereTime('start_time', '>=', now()->format('H:i:s'))
        ->whereTime('start_time', '<=', now()->addMinutes(30)->format('H:i:s'))
        ->get();
        // /room/detail/{id}/schedule={meeting_id}

        // \Log::info('Found ' . $upcomingMeetings->count() . ' meetings.');
        foreach ($upcomingMeetings as $meeting) {
            // \Log::info('Notifying user for meeting ID: ' . $meeting->id);
            // Send email notification

            $update = booking::where('id',$meeting->id)->first();
            $update->alerted = 1;
            $update->save();
            $user = User::where('id',$meeting->created_by_id)->first();
            \Log::info('USer : ' . $user );
            \Log::info('Meeting  : ' . $meeting );
            $mailData = [

                'fullName' => $meeting->staff_name,
                'start_time' => $meeting->start_time,
                'end_time' => $meeting->end_time,
                'room' => $meeting->room,
                'topic' => $meeting->title,
                'cancel_date' => today(),
                'url' => 'http://192.168.1.71:8700/room/detail/'.$meeting->room_id.'/schedule='.$meeting->id
            ];

            Mail::to($user->email)->send(new alert_upcoming_booking($mailData));
        }

        $this->info('Meeting reminders sent!');
    }
}
