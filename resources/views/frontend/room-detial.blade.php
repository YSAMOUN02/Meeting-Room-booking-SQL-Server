@extends('frontend.master')
@section('content')

    <section class="drop_slow1 laptop_respond dark:bg-sky-800">
        <div class="grid max-w-screen-xl py-1 px-4 md:px-4 lg:mx-auto lg:gap-8 xl:gap-0 lg:py-4 lg:px-0 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
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
            <div id="default-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Booking Panol Room
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="default-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="/room/detial/store" method="POST" onsubmit="disableSubmitButton(this)">

                            @csrf
                            <div class="p-5">
                                <div class="mb-5">
                                    <label for="room"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">Room selected
                                        <span class="text-rose-700">*</span></label>
                                    <input type="text" value="{{ old('room', $room->id ?? '') }}" id="room"
                                        name="room" class="hidden" required />
                                    <input type="text" name="ka" value="{{ old('ka', $room->room_name ?? '') }}"
                                        readonly
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="name@gmail.com" required />
                                </div>

                                <div class="mb-5">
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">Name <span
                                            class="text-rose-600">*</span></label>
                                    <input type="text" id="name" value="{{ old('name', Auth::user()->name ?? '') }}"
                                        readonly name="staff_name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="name@gmail.com" required />
                                </div>

                                <div class="mb-5">
                                    <label for="id"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">Staff ID <span
                                            class="text-rose-600">*</span></label>
                                    <input type="text" readonly
                                        value="{{ old('staff_id', Auth::user()->id_card ?? '') }}" id="id"
                                        name="staff_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required />
                                </div>

                                <div class="mb-5">
                                    <label for="department"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">Department<span
                                            class="text-rose-700">*</span></label>
                                    <select id="department" readonly name="staff_department"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                        <option selected
                                            value="{{ old('staff_department', Auth::user()->department ?? '') }}">
                                            {{ Auth::user()->department }}</option>
                                        <option value="Accounting">Accounting</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Comercail">Commercial</option>
                                        <option value="Design">Design</option>
                                        <option value="Export">Export</option>
                                        <option value="HR">HR</option>
                                        <option value="Finance">Finance</option>
                                        <option value="MIS">MIS</option>
                                        <option value="Logistic">Logistic</option>
                                        <option value="Management">Management</option>
                                        <option value="Marketing">Marketing</option>

                                        <option value="Planning">Planning</option>
                                        <option value="Production">Production</option>
                                        <option value="Purchase">Purchase</option>
                                        <option value="Purchase DPM">Purchase DPM</option>
                                        <option value="QA">QA</option>
                                        <option value="QC">QC</option>
                                        <option value="QM">QM</option>
                                        <option value="QP">QP</option>
                                        <option value="RA">RA</option>
                                        <option value="Sale">Sale</option>
                                        <option value="Warehouse">Warehouse</option>
                                        <option value="Other">Other</option>
                                        <!-- Add other departments as needed -->
                                    </select>
                                </div>

                                <div class="mb-5">
                                    <label for="meeting_type"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">Meeting Type
                                        <span class="text-rose-600">*</span></label>
                                    <div class="mx-auto grid grid-cols-2 gap-4">
                                        <div class="flex items-center mb-4">
                                            <input id="meeting" checked type="radio" value="Meeting"
                                                name="meeting_type"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="meeting"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-900">Meeting</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="training" type="radio" value="Training" name="meeting_type"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="training"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-900">Training</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <label for="description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">Meeting or
                                        Training
                                        Title </label>
                                    <textarea id="description" name="description" required rows="4"
                                        class="block p-2.5 w-full text-sm bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Write your thoughts here..."></textarea>
                                </div>
                                <div class="mb-5 grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="from_date"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">From Date
                                            <span class="text-rose-600">*</span></label>
                                        <input type="date" onchange="validation_data()" id="from_date"
                                            value="{{ date('Y-m-d') }}" name="from_date"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            required />
                                    </div>
                                    <div>
                                        <label for="to_date"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">To Date
                                            <span class="text-rose-600">*</span></label>
                                        <input onchange="validation_data()" type="date" id="to_date"
                                            value="{{ date('Y-m-d') }}" name="to_date"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            required />
                                    </div>
                                </div>
                                <div class="mb-5 grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="start_time"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">Start Time
                                            <span class="text-rose-600">*</span></label>
                                        <input onchange="validation_data()" type="time" id="start_time"
                                            name="start_time"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            required />
                                    </div>
                                    <div>
                                        <label for="end_time"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">End Time
                                            <span class="text-rose-600">*</span></label>
                                        <input onchange="validation_data()" type="time" id="end_time"
                                            name="end_time"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            required />
                                    </div>
                                </div>


                            </div>
                            <!-- Modal footer -->
                            <div
                                class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button type="button" id="btn_submit_booking"
                                    class="text-white  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Booking</button>
                                <button data-modal-hide="default-modal" type="button"
                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
                            </div>
                        </form>
                    </div>
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
                                Meeting Schedule </span>
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
            class="calendar drop_slow1 laptop_respond bg-white   flex  max-w-screen-xl px-4  py-2 mx-auto lg:gap-8 xl:gap-0 lg:py-4  ">
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
                            @if ($length == $last)
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
                                        {{ $item->meeting_type }} ({{ $item->department }}) <span
                                            class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ms-3">Latest</span>
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
                            @else
                                <li class="mb-10 ms-6">
                                    <span
                                        class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                        <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </span>
                                    <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $item->meeting_type }} ({{ $item->department }})</h3>
                                    <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                                        Topic : {{ $item->title }}</h3>
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
                    <h1 class=" leading-6 text-gray-900 text-2xl  font-bold">
                        @php
                            $today = today(); // Get today's date
use Carbon\Carbon;

$currentDate = now(); // Current date
$month = request('month', $currentDate->month); // Get month from query or default to current
$year = request('year', $currentDate->year); // Get year from query or default to current

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


                        <time datetime="{{ $today->format('Y-m') }}">
                            {{ $today->format('F Y') }}
                        </time>

                    </h1>

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

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
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
    </script>
@endsection
