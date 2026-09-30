<?php

namespace Tests\Feature;

use App\Models\booking;
use App\Services\ItSupportRequest;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

/**
 * Asking IT for a sound system or a microphone when a room is booked.
 *
 * Nothing here touches the database or leaves the machine: the booking is never
 * saved, and MIS is faked - a real call would post to the IT team's Telegram
 * group.
 */
class ItSupportRequestTest extends TestCase
{
    const URL = 'http://mis.test/request/relay';

    protected function setUp(): void
    {
        parent::setUp();

        config(['services.mis.relay_url' => self::URL, 'services.mis.relay_key' => 'test-key']);

        Http::preventStrayRequests();
    }

    private function booking()
    {
        $booking = new booking();
        $booking->id = 501;
        $booking->room = 'Kinal';
        $booking->room_id = '1';
        $booking->title = 'Quarterly review';
        $booking->meeting_type = 'Meeting';
        $booking->department = 'Administration & HR';
        $booking->date = '2026-10-05';
        $booking->start_time = '08:00';
        $booking->end_time = '10:30';
        $booking->created_by_name = 'Test Booker';

        return $booking;
    }

    public function test_it_files_the_request_and_returns_the_tracking_link()
    {
        Http::fake([self::URL => Http::response(['code' => '418U', 'track_url' => 'http://mis.test/request/track/418U'], 201)]);

        $result = ItSupportRequest::send($this->booking(), ['Sound system', 'Microphone'], '2026-10-05', '192.168.1.50');

        $this->assertSame(['code' => '418U', 'url' => 'http://mis.test/request/track/418U'], $result);

        Http::assertSent(function (Request $request) {
            return $request->url() === self::URL
                && $request->hasHeader('X-Relay-Key', 'test-key')
                && $request['name'] === 'Test Booker'
                && $request['ip'] === '192.168.1.50'
                && str_contains($request['issue'], 'Meeting room needs: Sound system, Microphone');
        });
    }

    public function test_the_issue_says_where_and_when()
    {
        $issue = ItSupportRequest::issue($this->booking(), ['Microphone'], '2026-10-05');

        $this->assertStringContainsString('Room: Kinal', $issue);
        $this->assertStringContainsString('Date: Mon 05 Oct 2026', $issue);
        $this->assertStringContainsString('Time: 08:00 AM - 10:30 AM', $issue);
        $this->assertStringContainsString('Topic: Quarterly review (Meeting)', $issue);
        $this->assertStringContainsString('Department: Administration & HR', $issue);
        $this->assertStringContainsString('/room/detail/1/schedule=501', $issue);
    }

    public function test_a_booking_over_several_days_is_one_request_naming_the_span()
    {
        $issue = ItSupportRequest::issue($this->booking(), ['Sound system'], '2026-10-07');

        $this->assertStringContainsString('Date: Mon 05 Oct 2026 to Wed 07 Oct 2026', $issue);
    }

    public function test_a_refusal_is_reported_as_not_sent()
    {
        Http::fake([self::URL => Http::response(['message' => ''], 403)]);

        $this->assertNull(ItSupportRequest::send($this->booking(), ['Microphone'], '2026-10-05', null));
    }

    public function test_mis_being_down_is_reported_as_not_sent()
    {
        Http::fake([self::URL => function () {
            throw new ConnectionException('Connection refused');
        }]);

        $this->assertNull(ItSupportRequest::send($this->booking(), ['Microphone'], '2026-10-05', null));
    }

    public function test_nothing_is_sent_until_it_is_configured()
    {
        config(['services.mis.relay_key' => null]);
        Http::fake();

        $this->assertNull(ItSupportRequest::send($this->booking(), ['Microphone'], '2026-10-05', null));

        Http::assertNothingSent();
    }
}
