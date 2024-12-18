
@extends('frontend.master')
@section('content')



    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <form action="/room/cancel" method="post" onsubmit="disableSubmitButton(this)">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Enter Reason code to cancel.</h3>


                        @csrf
                        <div class="flex flex-col">
                            <input type="text" class="hidden" id="value_delete" name="id">

                        </div>
                        <input type="text" id="reason"
                        name="reason"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Reason" required />


                        <button  type="submit" id="btn_submit_booking" class="mt-5 text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Cancel Booking
                        </button>
                    <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<section class="bg-gray-50 dark:bg-gray-900">
    <div class="w-full">
        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

            <div class="table_user_container overflow-x-auto">
                <table class="standard-table  table w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="hover_td_left px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Meeting Room </th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Topic </th>

                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Booked By</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Meeting Date</th>

                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">From Time</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">To Time</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Type</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Booked At</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Status</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Cancel By</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Reason</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Cancel Date</th>
                            <th scope="col" class="hover_td px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $state = 0;
                        @endphp
                        @foreach ($data as  $item)
                            @if (Auth::user()->id == $item->created_by_id)

                                <tr class="border-b dark:border-gray-700 selected">
                                    <th scope="row" class="hover_td_left px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->room}}</th>
                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{$item->title}}</td>

                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{$item->staff_name}}</td>
                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}</td>
                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{ \Carbon\Carbon::parse($item->start_time)->format('h:i A') }}</td>
                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{ \Carbon\Carbon::parse($item->end_time)->format('h:i A') }}</td>
                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{$item->meeting_type}}</td>
                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">
                                        @if($item->status == 0)
                                            <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                                <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                                Canceled
                                            </span>

                                        @else
                                        <span class="inline-flex items-center bg-amber-100 text-amber-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                            <span class="w-2 h-2 me-1 bg-amber-500 rounded-full"></span>
                                                On Going
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">
                                        {{$item->cancel_by_name}}
                                    </td>
                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">
                                        {{$item->cancel_reason}}
                                    </td>
                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">
                                        {{$item->cancel_date}}
                                    </td>
                                    <td class="hover_td px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">
                                        @if(Auth::user()->id == $item->created_by_id && $item->status == 1)

                                        <button type="button" onclick="delete_id({{$item->id}})" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Cancel</button>

                                        @endif
                                    </td>

                                </tr>
                                @php
                                    $state++;
                                @endphp
                            @else

                            <tr class="border-b dark:border-gray-700 ">
                                <th scope="row" class="hover_td_left px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->room}}</th>
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{$item->title}}</td>

                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{$item->staff_name}}</td>
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}</td>
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{ \Carbon\Carbon::parse($item->start_time)->format('h:i A') }}</td>
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{ \Carbon\Carbon::parse($item->end_time)->format('h:i A') }}</td>
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{$item->meeting_type}}</td>
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">
                                    @php
                                    $end = \Carbon\Carbon::parse($item->end_time)->format('h:i A');
                                    $date = \Carbon\Carbon::parse($item->date); // Keep as Carbon instance
                                    $today = \Carbon\Carbon::parse($current_date); // Keep as Carbon instance

                                   @endphp

                                   @if($item->status == 0)
                                       <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                           <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                           Canceled
                                       </span>
                                       @else
                                       <span class="inline-flex items-center bg-amber-100 text-amber-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                           <span class="w-2 h-2 me-1 bg-amber-500 rounded-full"></span>
                                           On Going
                                       </span>

                                   @endif

                                </td>
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">
                                    {{$item->cancel_by_name}}
                                </td>
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">
                                    {{$item->cancel_reason}}
                                </td>
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">
                                    {{$item->cancel_date}}
                                </td>
                                <td class="hover_td px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">
                                    @if (($item->created_by_id == Auth::user()->id || Auth::user()->role == 'admin'))

                                        <button type="button" onclick="delete_id({{$item->id}})" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-4 py-1 text-center me-2 mb-2 md:px-5 md:py-2.5">Cancel</button>

                                    @endif
                                </td>

                            </tr>
                        @php
                            $state++;
                        @endphp
                            @endif

                        @endforeach

                        @if($state == 0)
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">No Bookng Data</th>

                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>

                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </section>
    <script>
               function disableSubmitButton(form) {
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerText = "Processing..."; // Optional: change the button text
    }
    </script>
@endsection
