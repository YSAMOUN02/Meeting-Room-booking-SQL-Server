<?php

namespace App\Services;

use App\Models\booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Asks the IT team for a sound system or a microphone for a booked meeting.
 *
 * The request goes to the IT team's own request system (MIS, port 9800), which
 * puts it in their inbox, posts it to their Telegram group and gives it a
 * tracking code. The booking is already saved when this runs, so a failure here
 * is logged and shown to the person - it never undoes or breaks the booking.
 */
class ItSupportRequest
{
    /**
     * Seconds to wait for MIS. It answers once it has posted to Telegram, which
     * usually takes a few seconds but can take longer on a bad connection.
     */
    const TIMEOUT = 20;

    /**
     * @param  string[]  $needs  what was ticked, e.g. ['Sound system', 'Microphone']
     * @return array|null  ['code' => ..., 'url' => ...], or null if MIS did not take it
     */
    public static function send(booking $booking, array $needs, string $to_date, ?string $ip)
    {
        $url = config('services.mis.relay_url');
        $key = config('services.mis.relay_key');

        if (empty($url) || empty($key)) {
            Log::warning('IT request not sent: MIS_RELAY_URL or MIS_RELAY_KEY is not set.', ['booking_id' => $booking->id]);
            return null;
        }

        try {
            $response = Http::acceptJson()
                ->withHeaders(['X-Relay-Key' => $key])
                ->connectTimeout(5)
                ->timeout(self::TIMEOUT)
                ->post($url, [
                    'name' => $booking->created_by_name,
                    'issue' => self::issue($booking, $needs, $to_date),
                    'ip' => $ip,
                ]);

            if ($response->successful() && $response->json('code')) {
                return [
                    'code' => $response->json('code'),
                    'url' => $response->json('track_url'),
                ];
            }

            Log::warning('MIS refused the IT request.', [
                'booking_id' => $booking->id,
                'status' => $response->status(),
                'message' => $response->json('message'),
            ]);
        } catch (\Throwable $e) {
            Log::warning('MIS could not be reached for the IT request.', [
                'booking_id' => $booking->id,
                'error' => $e->getMessage(),
            ]);
        }

        return null;
    }

    /**
     * What the IT team reads, in Telegram and in their inbox. A booking over
     * several days is one request covering all of them.
     */
    public static function issue(booking $booking, array $needs, string $to_date)
    {
        $from = Carbon::parse($booking->date);
        $to = Carbon::parse($to_date);

        $date = $from->isSameDay($to)
            ? $from->format('D d M Y')
            : $from->format('D d M Y').' to '.$to->format('D d M Y');

        return implode("\n", [
            'Meeting room needs: '.implode(', ', $needs),
            '',
            'Room: '.$booking->room,
            'Date: '.$date,
            'Time: '.Carbon::parse($booking->start_time)->format('h:i A').' - '.Carbon::parse($booking->end_time)->format('h:i A'),
            'Topic: '.$booking->title.' ('.$booking->meeting_type.')',
            'Department: '.$booking->department,
            'Booking: '.url('/room/detail/'.$booking->room_id.'/schedule='.$booking->id),
        ]);
    }
}
