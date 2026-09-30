@extends('frontend.master')
@section('content')
    <link rel="stylesheet" href="{{ URL('assets/css/booking-modal.css') }}">

    {{-- After a booking that asked IT for a sound system or a microphone. Stays on
         the page (unlike the fading flash) so the tracking link can be opened. --}}
    @if (session('it_request'))
        @php
            $it_request = session('it_request');
        @endphp
        @if (!empty($it_request['code']))
            <div class="bk-notice max-w-screen-xl mx-auto mb-4 p-4 text-sm rounded-lg border bg-blue-50 text-blue-800 border-blue-300">
                <i class="fa-solid fa-headset mr-2"></i>
                {{ $it_request['needs'] }} requested from the IT team. Your request code is
                <span class="font-bold">{{ $it_request['code'] }}</span>.
                @if (!empty($it_request['url']))
                    <a href="{{ $it_request['url'] }}" target="_blank" class="font-medium underline">Track your request</a>
                @endif
            </div>
        @else
            <div class="bk-notice max-w-screen-xl mx-auto mb-4 p-4 text-sm rounded-lg border bg-yellow-50 text-yellow-800">
                <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                Your booking is saved, but the request for {{ $it_request['needs'] }} did not reach the IT
                team. Please contact IT directly.
            </div>
        @endif
    @endif

    <section class="drop_slow1 laptop_respond ">
        <div class="grid max-w-screen-xl py-1 px-4 md:px-4 lg:mx-auto lg:gap-8 xl:gap-0 lg:py-4 lg:px-0 lg:grid-cols-12 bg-white  dark:bg-gray-700">
            <div class="mr-auto place-self-center lg:col-span-7 px-6">
                @if (!empty($room))
                    <h1
                        class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                        {{ $room->room_name }} Meeting Room</h1>
                    <p class="max-w-2xl mb-6 font-bold text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                        {{ $room->description }} <br />
                        <span class="text-rose-500">Seat up to {{ $room->seat }} People.</span>
                    </p>
                @endif
                <div class="flex">
                    @if(!empty(Auth::user()))
                    <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    Book Now

                </button>
                    @else
                       <a href="\login">
                        <button
                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">
                        Book Now

                    </button>
                       </a>

                    @endif

                </div>
            </div>
            <div class="mt-1 lg:mt-0 lg:col-span-5 lg:flex">
                @if (!empty($room))
                    <img class="w-full object-cover rounded-t-lg" src="/Uploads/{{ $room->thumbnail }}" alt="" />
                @endif



            </div>
        </div>
    </section>



    <div class="room-booking  ">
        <div class="place-item-center  grid justify-items-start md:justify-items-center ">


        </div>



        <!-- Main modal -->
        @if (!empty(Auth::user()))
            @php
                // "CHHEUN Lyza" -> "CL", for the avatar beside the booker's name.
                $booker = Auth::user();
                $booker_initials = collect(preg_split('/\s+/', trim((string) $booker->name)))
                    ->filter()
                    ->take(2)
                    ->map(fn ($word) => mb_strtoupper(mb_substr($word, 0, 1)))
                    ->implode('');
                $booker_meta = collect([$booker->id_card, $booker->department])->filter()->implode(' · ');
            @endphp
            <div id="default-modal" tabindex="-1" aria-hidden="true" aria-labelledby="bk_title"
                class="bk-modal hidden fixed z-50 justify-center items-center overflow-y-auto overflow-x-hidden">
                <div class="bk-dialog">
                    <form class="bk-card" action="/room/detial/store" method="POST" onsubmit="disableSubmitButton(this)">
                        @csrf
                        {{-- Fixed by the page and the login, so sent rather than typed. --}}
                        <input type="hidden" id="room" name="room" value="{{ old('room', $room->id ?? '') }}">
                        <input type="hidden" name="ka" value="{{ old('ka', $room->room_name ?? '') }}">
                        <input type="hidden" id="name" name="staff_name" value="{{ old('name', $booker->name ?? '') }}">
                        <input type="hidden" id="id" name="staff_id" value="{{ old('staff_id', $booker->id_card ?? '') }}">
                        <input type="hidden" id="department" name="staff_department"
                            value="{{ old('staff_department', $booker->department ?? '') }}">

                        <!-- Modal header -->
                        <div class="bk-head">
                            @if (!empty($room->thumbnail))
                                <img class="bk-thumb" src="/Uploads/{{ $room->thumbnail }}" alt="">
                            @else
                                <span class="bk-badge"><i class="fa-solid fa-calendar-plus"></i></span>
                            @endif
                            <div class="bk-head-text">
                                <h3 id="bk_title" class="bk-title">Book {{ $room->room_name ?? 'this room' }}</h3>
                                <p class="bk-sub"><i class="fa-solid fa-chair"></i>Seats up to {{ $room->seat ?? '-' }} people</p>
                            </div>
                            <button type="button" class="bk-close" data-modal-hide="default-modal" aria-label="Close">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>

                        <!-- Modal body -->
                        <div class="bk-body">
                            <div class="bk-person">
                                <span class="bk-avatar">
                                    @if ($booker_initials !== '')
                                        {{ $booker_initials }}
                                    @else
                                        <i class="fa-solid fa-user"></i>
                                    @endif
                                </span>
                                <div class="bk-person-text">
                                    <span class="bk-overline">Booking as</span>
                                    <span class="bk-person-name">{{ $booker->name }}</span>
                                    <span class="bk-person-meta">{{ $booker_meta }}</span>
                                </div>
                            </div>

                            <div class="bk-field">
                                <span class="bk-label">Type</span>
                                <div class="bk-segment" role="radiogroup" aria-label="Meeting type">
                                    <div class="bk-choice">
                                        <input id="meeting" type="radio" value="Meeting" name="meeting_type" checked>
                                        <label for="meeting"><i class="fa-solid fa-users"></i>Meeting</label>
                                    </div>
                                    <div class="bk-choice">
                                        <input id="training" type="radio" value="Training" name="meeting_type">
                                        <label for="training"><i class="fa-solid fa-chalkboard-user"></i>Training</label>
                                    </div>
                                </div>
                            </div>

                            <div class="bk-field">
                                <label for="description" class="bk-label">Meeting or training title <span
                                        class="bk-req">*</span></label>
                                <textarea id="description" name="description" required rows="3" class="bk-input"
                                    placeholder="e.g. Monthly sales review"></textarea>
                            </div>

                            <div class="bk-field">
                                <span class="bk-label">When <span class="bk-req">*</span></span>
                                <div class="bk-when">
                                    <div>
                                        <label for="from_date" class="bk-mini">From date</label>
                                        <input type="date" onchange="validation_data()" id="from_date"
                                            value="{{ date('Y-m-d') }}" name="from_date" class="bk-input" required />
                                    </div>
                                    <div>
                                        <label for="to_date" class="bk-mini">To date</label>
                                        <input type="date" onchange="validation_data()" id="to_date"
                                            value="{{ date('Y-m-d') }}" name="to_date" class="bk-input" required />
                                    </div>
                                    <div>
                                        <label for="start_time" class="bk-mini">Start time</label>
                                        <input type="time" onchange="validation_data()" id="start_time"
                                            name="start_time" class="bk-input" required />
                                    </div>
                                    <div>
                                        <label for="end_time" class="bk-mini">End time</label>
                                        <input type="time" onchange="validation_data()" id="end_time"
                                            name="end_time" class="bk-input" required />
                                    </div>
                                </div>
                            </div>

                            {{-- Optional and unticked: most meetings need neither. Ticking one
                                 files a request with the IT team when the booking is saved. --}}
                            <div class="bk-field">
                                <span class="bk-label">Need from IT <span class="bk-optional">Optional</span></span>
                                <div class="bk-chips">
                                    <div class="bk-choice">
                                        <input id="need_sound" type="checkbox" value="1" name="need_sound">
                                        <label for="need_sound"><span class="bk-chip-icon"><i
                                                    class="fa-solid fa-volume-high"></i></span>Sound system</label>
                                    </div>
                                    <div class="bk-choice">
                                        <input id="need_microphone" type="checkbox" value="1" name="need_microphone">
                                        <label for="need_microphone"><span class="bk-chip-icon"><i
                                                    class="fa-solid fa-microphone"></i></span>Microphone</label>
                                    </div>
                                </div>
                                <p class="bk-hint"><i class="fa-solid fa-circle-info"></i>Tick only what you need. The IT
                                    team gets your request on Telegram when you book.</p>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="bk-foot">
                            <p id="bk_status" class="bk-status" aria-live="polite"><i class="fa-solid fa-clock"></i>Pick a
                                date and time. We check the room is free.</p>
                            <button data-modal-hide="default-modal" type="button" class="bk-btn bk-btn-ghost">Cancel</button>
                            {{-- script.js makes this a submit button once the room is free;
                                 clicking it before then runs that check. --}}
                            <button type="button" id="btn_submit_booking" class="bk-btn"
                                onclick="if (this.type === 'button') validation_data()">Book room</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <div id="default-modal2" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        @if (!empty($room))
                            <span class="text-xl font-semibold text-gray-900 dark:text-white">{{ $room->room_name }}'s
                                Meeting Schedule</span>
                        @endif
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="default-modal2">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <section
                        class="calendar drop_slow1 laptop_respond bg-white   flex  max-w-screen-xl px-4  py-2 mx-auto lg:gap-8 xl:gap-0 lg:py-4  ">
                        <div>
                            <ol id="schedule_show" class="relative border-s border-gray-200 dark:border-gray-700 mt-5">
                        </div>

                    </section>
                </div>
            </div>
        </div>
        <section
            class="calendar drop_slow1 laptop_respond bg-white   flex  max-w-screen-xl px-4  py-2 mx-auto lg:gap-8 xl:gap-0 lg:py-4    dark:bg-gray-700  p-4">
            <div class="me-2">
                @if (!empty($room))
                    <span class="text-xl font-semibold text-gray-900 dark:text-white">{{ $room->room_name }}'s Meeting
                        Schedule </span>
                @endif

                <ol class="relative border-s border-gray-200 dark:border-gray-700 mt-5">


                    @if (!empty($booking_today))
                        @php
                            $length = 1;

                        @endphp
                        @foreach ($booking_today as $item)

                            @php
                                if (empty($meeting_id )){
                                    $meeting_id = 0;
                                }
                            @endphp
                            @if ($meeting_id == $item->id)

                                <li class="mb-10 ms-6 ">
                                    <span
                                        class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                        <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </span>
                                    <h3 class="alert_notification flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                                       Upcomming's Schedule

                                    </h3>
                                    <h3 class="alert_notification flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $item->meeting_type }} ({{ $item->department }})
                                        @if ($length == $last)
                                        <span
                                            class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ms-3">Latest</span>
                                        @endif
                                    </h3>
                                    <h3 class="alert_notification flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                                        Topic : {{ $item->title }}</h3>
                                    <span
                                        class="alert_notification block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Booked
                                        By: {{ $item->staff_name }}</span>
                                    <time
                                        class="alert_notification block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Meeting
                                        Date: {{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}</time>
                                    <time
                                        class=" alert_notification block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Meeting
                                        Time: {{ \Carbon\Carbon::parse($item->start_time)->format('h:i A') }}
                                        To {{ \Carbon\Carbon::parse($item->end_time)->format('h:i A') }}</time>

                                </li>
                            @else
                                <li class="mb-10 ms-6 ">
                                    <span
                                        class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                        <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </span>
                                    <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $item->meeting_type }} ({{ $item->department }})
                                        @if ($length == $last)
                                        <span
                                            class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ms-3">Latest</span>
                                        @endif
                                    </h3>
                                    <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                                        Topic : {{ $item->title }}</h3>
                                    <span
                                        class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Booked
                                        By: {{ $item->staff_name }}</span>
                                    <time
                                        class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Meeting
                                        Date: {{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}</time>
                                    <time
                                        class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Meeting
                                        Time: {{ \Carbon\Carbon::parse($item->start_time)->format('h:i A') }}
                                        To {{ \Carbon\Carbon::parse($item->end_time)->format('h:i A') }}</time>

                                </li>

                            @endif

                            @php
                                $length += 1;
                            @endphp
                        @endforeach
                        @if ($length == 1)
                            <li class="mb-10 ms-6">
                                <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">No
                                    Booking Data <span
                                        class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ms-3">Latest</span>
                                </h3>
                            </li>
                        @endif
                    @endif
                </ol>
                <div>
                    <!-- component -->

                </div>
            </div>
            <div class=" w-full flex flex-col py-1 px-4 md:px-4 lg:mx-auto lg:gap-8 xl:gap-0 lg:pt-0 pb-4 lg:px-0">
                <header class="flex items-center justify-between  border-gray-200 px-1 lg:px-0 pt-0 pb-4 lg:flex-none">
                    <div class=" leading-6 text-gray-900 text-2xl  font-bold">
                        @php
                            $today = today(); // Get today's date
                            use Carbon\Carbon;

                            $currentDate = now(); // Current date
                            // Month/year picked in the header, defaulting to the current month
                            $month = (int) ($month ?? request('month', $currentDate->month));
                            $year = (int) ($year ?? request('year', $currentDate->year));

                            if ($month < 1 || $month > 12) {
                                $month = $currentDate->month;
                            }
                            if ($year < 2000 || $year > 2100) {
                                $year = $currentDate->year;
                            }

                            // Generate the first and last day of the selected month
                            $startOfMonth = Carbon::createFromDate($year, $month, 1);
                            $endOfMonth = $startOfMonth->copy()->endOfMonth();

                            // Get the first day of the week and last day of the week for calendar alignment
                            $startOfCalendar = $startOfMonth->copy()->startOfWeek();
                            $endOfCalendar = $endOfMonth->copy()->endOfWeek();

                            // Build days for the calendar
                            $days = [];
                            $currentDay = $startOfCalendar->copy();
                            while ($currentDay <= $endOfCalendar) {
                                $days[] = $currentDay->copy();
                                $currentDay->addDay();
                            }
                            $count_day = count($days);
                        @endphp


                        <form method="GET" action="{{ url()->current() }}" class="flex items-center gap-2">
                            <select name="month" onchange="this.form.submit()"
                                class="text-2xl font-bold text-gray-900 bg-white border border-gray-300 rounded px-2 py-1">
                                @foreach (range(1, 12) as $month_option)
                                    <option value="{{ $month_option }}" {{ $month == $month_option ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $month_option, 1)) }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="text" name="year" value="{{ $year }}" inputmode="numeric" maxlength="4"
                                onchange="this.form.submit()" style="width: 6rem;"
                                class="text-2xl font-bold text-gray-900 bg-white border border-gray-300 rounded px-2 py-1">
                            <noscript>
                                <button type="submit"
                                    class="text-sm font-bold text-gray-900 bg-white border border-gray-300 rounded px-2 py-1">Go</button>
                            </noscript>
                        </form>

                    </div>

                </header>
                <div class="shadow w-full  mt-2 ring-1 ring-black ring-opacity-5 lg:flex lg:flex-auto lg:flex-col">
                    <div
                        class="grid grid-cols-7 gap-px border-b border-gray-300 bg-gray-200 text-center text-xs font-semibold leading-6 text-gray-700 lg:flex-none">
                        <div class="flex justify-center bg-white py-2">
                            <span>M</span>
                            <span class="sr-only sm:not-sr-only">on</span>
                        </div>
                        <div class="flex justify-center bg-white py-2">
                            <span>T</span>
                            <span class="sr-only sm:not-sr-only">ue</span>
                        </div>
                        <div class="flex justify-center bg-white py-2">
                            <span>W</span>
                            <span class="sr-only sm:not-sr-only">ed</span>
                        </div>
                        <div class="flex justify-center bg-white py-2">
                            <span>T</span>
                            <span class="sr-only sm:not-sr-only">hu</span>
                        </div>
                        <div class="flex justify-center bg-white py-2">
                            <span>F</span>
                            <span class="sr-only sm:not-sr-only">ri</span>
                        </div>
                        <div class="flex justify-center bg-white py-2">
                            <span>S</span>
                            <span class="sr-only sm:not-sr-only">at</span>
                        </div>
                        <div class="flex justify-center bg-white py-2">
                            <span>S</span>
                            <span class="sr-only sm:not-sr-only">un</span>
                        </div>
                    </div>
                    <div class="flex bg-gray-200 text-xs leading-6 text-gray-700 lg:flex-auto">
                        @if ($count_day <= 35)
                            <div class=" w-full grid  lg:grid grid-cols-7  lg:grid-cols-7 lg:grid-rows-5 lg:gap-px">
                                @foreach ($days as $day)
                                    @php
                                        $qty_booked_a_day = 0;
                                        $day_by_month = new \DateTime($day);
                                        $day_click = \Carbon\Carbon::parse($day)->format('d');
                                        $month_click = \Carbon\Carbon::parse($day)->format('m');
                                        $year_click = \Carbon\Carbon::parse($day)->format('Y');
                                    @endphp
                                    @if (!empty($booking_data))
                                        @foreach ($booking_data as $booked)
                                            @php

                                                $booked_day = new \DateTime($booked->date);

                                                if ($day_by_month == $booked_day) {
                                                    $qty_booked_a_day += 1;
                                                }

                                            @endphp
                                        @endforeach
                                    @endif

                                    @if (today() == $day)
                                        <div class=" day relative bg-white px-3 py-2" data-modal-target="default-modal2"
                                            data-modal-toggle="default-modal2"
                                            onclick="show_schedule({{ $day_click }},{{ $month_click }},{{ $year_click }})">
                                            <time datetime="2022-01-12"
                                                class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white">{{ \Carbon\Carbon::parse(today())->format('d ') }}</time>
                                            @if ($qty_booked_a_day != 0)
                                                <ol class="mt-2">
                                                    <li>
                                                        <div class="group flex">
                                                            <p
                                                                class="date_for_pc flex-auto truncate font-medium text-rose-600 group-hover:text-indigo-600">
                                                                {{ $qty_booked_a_day }} Meeting</p>
                                                            <p
                                                                class="date_for_mobile flex-auto truncate font-sm text-rose-600 group-hover:text-indigo-600">
                                                                {{ $qty_booked_a_day }}*</p>

                                                        </div>

                                                    </li>
                                                </ol>
                                            @endif
                                        </div>
                                    @else
                                        <div class="day relative bg-gray-50 px-3 py-2" data-modal-target="default-modal2"
                                            data-modal-toggle="default-modal2"
                                            onclick="show_schedule({{ $day_click }},{{ $month_click }},{{ $year_click }})">
                                            <time datetime="2022-01-12"
                                                class="day relative bg-gray-50 text-gray-500">{{ \Carbon\Carbon::parse($day)->format('d') }}</time>
                                            @if ($qty_booked_a_day != 0)
                                                <ol class="mt-2">
                                                    <li>
                                                        <div class="group flex">
                                                            <p
                                                                class="date_for_pc flex-auto truncate font-medium text-rose-600 group-hover:text-indigo-600">
                                                                {{ $qty_booked_a_day }} Meeting</p>
                                                            <p
                                                                class="date_for_mobile flex-auto truncate font-sm text-rose-600 group-hover:text-indigo-600">
                                                                {{ $qty_booked_a_day }}*</p>

                                                        </div>
                                                    </li>
                                                </ol>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        @else
                            <div class=" w-full grid  lg:grid grid-cols-7  lg:grid-cols-7 lg:grid-rows-6 lg:gap-px">
                                @foreach ($days as $day)
                                    @php
                                        $qty_booked_a_day = 0;
                                        $day_by_month = new \DateTime($day);
                                        $day_click = \Carbon\Carbon::parse($day)->format('d');
                                        $month_click = \Carbon\Carbon::parse($day)->format('m');
                                        $year_click = \Carbon\Carbon::parse($day)->format('Y');
                                    @endphp
                                    @if (!empty($booking_data))
                                        @foreach ($booking_data as $booked)
                                            @php

                                                $booked_day = new \DateTime($booked->date);

                                                if ($day_by_month == $booked_day) {
                                                    $qty_booked_a_day += 1;
                                                }

                                            @endphp
                                        @endforeach
                                    @endif

                                    @if (today() == $day)
                                        <div class=" day relative bg-white px-3 py-2" data-modal-target="default-modal2"
                                            data-modal-toggle="default-modal2"
                                            onclick="show_schedule({{ $day_click }},{{ $month_click }},{{ $year_click }})">
                                            <time datetime="2022-01-12"
                                                class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white">{{ \Carbon\Carbon::parse(today())->format('d ') }}</time>
                                            @if ($qty_booked_a_day != 0)
                                                <ol class="mt-2">
                                                    <li>
                                                        <div class="group flex">
                                                            <p
                                                                class="date_for_pc flex-auto truncate font-medium text-rose-600 group-hover:text-indigo-600">
                                                                {{ $qty_booked_a_day }} Meeting</p>
                                                            <p
                                                                class="date_for_mobile flex-auto truncate font-sm text-rose-600 group-hover:text-indigo-600">
                                                                {{ $qty_booked_a_day }}*</p>

                                                        </div>

                                                    </li>
                                                </ol>
                                            @endif
                                        </div>
                                    @else
                                        <div class="day relative bg-gray-50 px-3 py-2" data-modal-target="default-modal2"
                                            data-modal-toggle="default-modal2"
                                            onclick="show_schedule({{ $day_click }},{{ $month_click }},{{ $year_click }})">
                                            <time datetime="2022-01-12"
                                                class="day relative bg-gray-50 text-gray-500">{{ \Carbon\Carbon::parse($day)->format('d') }}</time>
                                            @if ($qty_booked_a_day != 0)
                                                <ol class="mt-2">
                                                    <li>
                                                        <div class="group flex">
                                                            <p
                                                                class="date_for_pc flex-auto truncate font-medium text-rose-600 group-hover:text-indigo-600">
                                                                {{ $qty_booked_a_day }} Meeting</p>
                                                            <p
                                                                class="date_for_mobile flex-auto truncate font-sm text-rose-600 group-hover:text-indigo-600">
                                                                {{ $qty_booked_a_day }}*</p>

                                                        </div>
                                                    </li>
                                                </ol>
                                            @endif
                                        </div>

                                        {{-- @else
                            <div class="day relative bg-gray-50 px-3 py-2 text-gray-500" data-modal-target="default-modal2" data-modal-toggle="default-modal2">
                                <time datetime="2021-12-29">{{ \Carbon\Carbon::parse($day)->format('d ') }}</time>
                            </div> --}}
                                    @endif
                                @endforeach

                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </section>


        <!-- End of form input -->

    </div>

    </div>

    <script src="{{ URL('assets/js/flowbite.min.js') }}"></script>

    <script>
        let book_data = @json($booking_data);

        function generateTimeOptions() {
            const times = [];
            // Generate a list of times from your desired range (e.g., 8:00 AM to 5:00 PM)
            for (let hour = 8; hour < 18; hour++) {
                for (let minute = 0; minute < 60; minute += 30) { // Assuming 30-minute intervals
                    const time = `${hour}:${minute < 10 ? '0' : ''}${minute}`;
                    times.push(time);
                }
            }
            return times;
        }

        function disableSubmitButton(form) {
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerText = "Processing..."; // Optional: change the button text
    }

        // Say beside the book button whether it can be pressed yet: script.js
        // makes it a submit button only once it has checked the room is free.
        (function () {
            const button = document.getElementById('btn_submit_booking');
            const status = document.getElementById('bk_status');

            if (!button || !status) {
                return;
            }

            const show = function () {
                const ready = button.getAttribute('type') === 'submit';

                status.classList.toggle('is-ready', ready);
                status.innerHTML = ready
                    ? '<i class="fa-solid fa-circle-check"></i>The room is free. Ready to book.'
                    : '<i class="fa-solid fa-clock"></i>Pick a date and time. We check the room is free.';
            };

            new MutationObserver(show).observe(button, { attributes: true, attributeFilter: ['type'] });
        })();

        // Let the booking form animate out. Flowbite hides it the instant it is
        // asked to, so the ways of closing it - the X, Cancel, a click on the
        // blurred background, Escape - are caught first, the form plays its
        // exit (.bk-closing in booking-modal.css), and then Cancel is clicked
        // for real so Flowbite closes it exactly as it always has.
        (function () {
            const modal = document.getElementById('default-modal');
            const cancel = modal ? modal.querySelector('.bk-btn-ghost[data-modal-hide]') : null;
            const lessMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            if (!modal || !cancel || lessMotion) {
                return;
            }

            let passing = false;

            const closeAnimated = function (event) {
                if (passing || modal.classList.contains('hidden') || modal.classList.contains('bk-closing')) {
                    return;
                }

                event.preventDefault();
                event.stopImmediatePropagation();
                modal.classList.add('bk-closing');

                setTimeout(function () {
                    passing = true;
                    cancel.click();
                    passing = false;
                    modal.classList.remove('bk-closing');
                }, 200);
            };

            document.addEventListener('click', function (event) {
                const target = event.target instanceof Element ? event.target : null;

                if (target && (target === modal || target.closest('[data-modal-hide="default-modal"]'))) {
                    closeAnimated(event);
                }
            }, true);

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closeAnimated(event);
                }
            }, true);
        })();
    </script>
@endsection
