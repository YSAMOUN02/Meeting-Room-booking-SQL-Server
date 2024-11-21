@extends('frontend.master')
@section('content')
<div class="mx-auto max-w-screen-xl drop_slow2">
    <h1 class="text-2xl lg:text-4xl font-black text-gray-600 p-4 py-1 lg:py-4 ">Meeting Room Booking</h1>
  </div>
<!-- Card booking  -->


  <div  class="drop_slow1  py-1 lg:p-4 mb-10 border-2 border-gray-200 border-dashed rounded-lg dark:border-sky-700 mt-1 lg:mt-14 mx-auto max-w-screen-xl">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        @if(!empty($room ))
            @foreach ($room as $item)
                <div class="card_room w-full bg-white border border-sky-200 rounded-lg shadow dark:bg-gray-100 dark:border-sky-600">
                    <a href="/room/detail/{{$item->id}}">
                    <img class="w-full object-cover rounded-t-lg" src="Uploads/{{$item->thumbnail}}" alt="" />
                    </a>
                    <div class="p-5">
                    <a href="/room/detail/{{$item->id}}">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-sky-900 ">
                          {{$item->room_name}}
                        </h5>
                    </a>
                    <p class="mb-3 font-normal text-white-700 dark:text-sky-500">
                        {{$item->description}} <br />
                        <span class="text-rose-500">Seat up to {{$item->seat}} People.</span>
                    </p>
                    <a href="/room/detail/{{$item->id}}" class="btn_book inline-flex items-center px-3 py-2 text-sm font-medium text-center border border-sky-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-400 text-gray-900 dark:bg-sky-300 hover:text-white dark:hover:bg-sky-700 dark:focus:ring-sky-800">
                        <button type="button">
                        Book Now
                        </button>
                    </a>
                    </div>
                </div>
            @endforeach

        @endif
    </div>
  </div>
<!-- end of card booking  -->



@endsection
