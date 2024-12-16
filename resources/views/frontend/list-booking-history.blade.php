
@extends('frontend.master')
@section('content')





<section class="bg-gray-50 dark:bg-gray-900">
    <div class="w-full">
        <!-- Start coding here -->
        {{-- <div class="w-full phone_respond flex justify-between p-2">

           <div class="flex">
            <div id="hidden_search" class="search me-2">
                <select  id="type2" onchange="validation()">
                    <option value="room">Meeting Room</option>
                    <option value="title">Topic</option>
                    <option value="meeting_type">Type</option>
                    <option value="created_by_name">Book By</option>
                    <option value="department">Department</option>
                    <option value="status">status</option>
                    <option value="year">Year</option>
                </select>
                <input type="text" id="value2" >
                <button  onclick="more_search(0)"><i class="fa-solid fa-minus"></i></button>



            </div>
            <div id="hidden_search2" class="search me-2">
                <select  id="type" onchange="validation()">
                    <option value="room">Meeting Room</option>
                    <option value="title">Topic</option>
                    <option value="meeting_type">Type</option>
                    <option value="created_by_name">Book By</option>
                    <option value="department">Department</option>
                    <option value="status">status</option>
                    <option value="year">Year</option>
                </select>
                <input type="text" id="value" >
                <button onclick="search_book_data(1)" id="btn_search" ><i class="fa-solid fa-magnifying-glass"></i></button>
                <button  id="more_button" onclick="more_search(1)"><i class="fa-solid fa-plus"></i></button>

            </div>

           </div>
            <div class="p-2 text-center">
                <kbd id="total_user" class="px-4 py-1.5 text-lg font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Total : {{$total_record}} Record</kbd>

            </div>
        </div> --}}

        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

            <div class="table_user_container overflow-x-auto">
                <table class="standard-table  table w-full text-sm  text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Booking ID</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Meeting Room </th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Topic </th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Type</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Meeting Date</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">From Time</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">To Time</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Booked By</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Department</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Booked At</th>

                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Cancel By</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Reason</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Cancel Date</th>
                            <th scope="col" class="hover_td px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $state = 0;
                        @endphp
                        @foreach ($data as  $item)


                            <tr class="border-b dark:border-gray-700 ">
                                <th class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->id}}</th>
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{$item->room}}</td>
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{$item->title}}</td>
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{$item->meeting_type}}</td>

                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{ \Carbon\Carbon::parse($item->date)->format('d F Y') }} </td>
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{ \Carbon\Carbon::parse($item->start_time)->format('h:i A') }}</td>
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{ \Carbon\Carbon::parse($item->end_time)->format('h:i A') }}</td>
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{$item->staff_name}}</td>
                                @if ($item->department == 'Choose Department')
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3"></td>
                                @else
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{$item->department}}</td>
                                @endif

                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>

                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">
                                    {{$item->cancel_by_name}}
                                </td>
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">
                                    {{$item->cancel_reason}}
                                </td>
                                <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">
                                    {{$item->cancel_date}}
                                </td>
                                <td class=" hover_td px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">
                                    @php
                                     $end = \Carbon\Carbon::parse($item->end_time)->format('h:i A');
                                     $day = \Carbon\Carbon::parse($item->date)->format('d');
                                     $booked_month =  \Carbon\Carbon::parse($item->date)->format('m');
                                     $booked_year =  \Carbon\Carbon::parse($item->date)->format('Y');
                                     $today =  \Carbon\Carbon::parse($current_date)->format('d');
                                     $current_month =  \Carbon\Carbon::parse($current_date)->format('m');
                                     $current_year =  \Carbon\Carbon::parse($current_date)->format('Y');
                                    @endphp

                                        @if($item->status == 0)
                                        <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                            <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                            Canceled
                                        </span>
                                        @elseif($item->status == 1 &&  $current_month > $booked_month && $current_year >=  $booked_year )

                                        <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                            <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>

                                            Completed
                                        </span>



                                        @elseif($item->status == 1 &&  $current_month == $booked_month  && $today > $day  )

                                        <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                            <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>

                                            Completed
                                        </span>


                                        @elseif($item->status == 1 && $today <= $day  )
                                        <span class="inline-flex items-center bg-amber-100 text-amber-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                            <span class="w-2 h-2 me-1 bg-amber-500 rounded-full"></span>

                                            On Going
                                        </span>
                                        @elseif($item->status == 1 && $current_year <  $booked_year  )
                                        <span class="inline-flex items-center bg-amber-100 text-amber-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                            <span class="w-2 h-2 me-1 bg-amber-500 rounded-full"></span>

                                            On Going
                                        </span>

                                        @endif

                                </td>
                            </tr>
                        @php
                            $state++;
                        @endphp


                        @endforeach

                        @if($state == 0)
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">No Bookng Data</th>

                            <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3"></td>
                            <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3"></td>
                            <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3"></td>
                            <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3"></td>
                            <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3"></td>
                            <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3"></td>
                            <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3"></td>
                            <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">

                            </td>
                        </tr>

                        @endif
                    </tbody>
                </table>
            </div>


            <div class="p-2 w-full flex justify-between">
                <div></div>
                <div class="max-w-full flex justify-between ">
                    {{-- Override when search  --}}
                    <div class="pagination_by_search defualt item-center flex ">
                        @if (!empty($total_page))
                            @php
                                $left_limit = max(1, $page - 5); // Set the left boundary, but not below 1
                                $right_limit = min($total_page, $page + 5); // Set the right boundary, but not above the total pages
                            @endphp
                            <nav aria-label="Page navigation example">
                                <ul class="flex items-center -space-x-px h-8 text-sm">

                                    {{-- Previous Button --}}
                                    @if ($page != 1)
                                        <li>
                                            <a href="{{ $page - 1 }}"
                                                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                                <i class="fa-solid fa-angle-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Page Numbers in Ascending Order --}}
                                    @for ($i = $left_limit; $i <= $right_limit; $i++)
                                        {{-- Loop from left to right in ascending order --}}
                                        @if ($i == $page)
                                            <li>
                                                <a href="{{ $i }}" aria-current="page"
                                                    class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">{{ $i }}</a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ $i }}"
                                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $i }}</a>
                                            </li>
                                        @endif
                                    @endfor

                                    {{-- Next Button --}}
                                    @if ($page != $total_page)
                                        <li>
                                            <a href="{{ $page + 1 }}"
                                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                                <i class="fa-solid fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                            </nav>
                        @endif

                    </div>

                </div>


            </div>









        </div>
    </div>
    </section>
@endsection
