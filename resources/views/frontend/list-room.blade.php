
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
                <form action="/room/delete/submit" method="post">
                    @csrf
                    <input type="text" class="hidden" id="value_delete" name="id">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this user ?</h3>
                <button  data-modal-hide="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="popup-modal2" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal2">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5">
                <form action="/room/update/submit" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="w-full grid gap-6 mb-6 md:grid-cols-1">

                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                            <input type="text" class="hidden" name="id" id="id">
                        </div>
                        <div>
                            <label for="seat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seat</label>
                            <input type="number" id="seat" name="seat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                        </div>
                        <div>
                            <label for="seat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thumbnail</label>
                            <img id="thumbnail" src="" alt="">
                            <input type="file"  name="thumbnail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="imageInput">
                        </div>
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrpition</label>
                            <textarea name="description" id="description"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" cols="30" rows="10"></textarea>
                        </div>

                    </div>


                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<section class="drop_slow1 bg-gray-50 dark:bg-gray-900">
    <div class="w-full">
        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

            <div class="overflow-x-auto">
                <table class="table w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Thumnail</th>
                            <th scope="col" class="px-4 py-3">ID</th>
                            <th scope="col" class="px-4 py-3">Name</th>
                            <th scope="col" class="px-4 py-3">Descriptin</th>
                            <th scope="col" class="px-4 py-3">Seat quantity</th>
                            <th scope="col" class="px-4 py-3">Create By</th>
                            <th scope="col" class="hover_td px-4 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody >
                        @if(!empty($room))
                            @php
                                $index = 0;
                            @endphp
                            @foreach ($room  as $item )
                                <tr class="border-b dark:border-gray-700">
                                    <th scope="row"  class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"><img width="200px" src="/Uploads/{{$item->thumbnail}}" alt="Image"></th>
                                    <td class="px-4 py-3">{{$item->id}}</td>
                                    <td class="px-4 py-3">{{$item->room_name}}</td>
                                    <td class="px-4 py-3">{{$item->description}}</td>
                                    <td class="px-4 py-3">{{$item->seat}}</td>
                                    <td class="px-4 py-3">{{$item->Created_by}}</td>


                                    <td class="hover_td px-4 py-3">
                                        <button type="button" onclick="edit_room({{$index}})" data-modal-target="popup-modal2" data-modal-toggle="popup-modal2" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                           @if (Auth::user()->role == 'admin')
                                           <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                           @else
                                           <i class="fa-solid fa-eye" style="color: #ffffff;"></i>

                                           @endif


                                        </button>
                                        @if (Auth::user()->role == 'admin')
                                        <button type="button"  onclick="delete_id({{$item->id}})"  data-modal-target="popup-modal" data-modal-toggle="popup-modal"  class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                $index ++;
                                @endphp
                            @endforeach

                        @endif





                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </section>
    <script>
        let room = @json($room);


        const imageInput = document.getElementById('imageInput');
       const preview = document.getElementById('thumbnail');
       imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0]; // Get the first selected file
            let filName  = imageInput.files.item(0).name;
            let extension = filName.split(".").pop();
            if (
                extension == "jpg" ||
                extension == "jpeg" ||
                extension == "gif" ||
                extension == "png"
            ){
                    if (file) {
                    const reader = new FileReader();

                    // When the file is loaded, update the preview image's src
                    reader.onload = function(e) {
                        preview.src = e.target.result; // Set the image source to the file data
                        preview.style.display = 'block'; // Show the image
                    };

                    // Read the image file as a Data URL
                    reader.readAsDataURL(file);
                }
            }else {
                imageInput.value = '';
                alert(
                   "File is Unknown! , FIle allow is  JPG  JPEG  GIF PNG"
                );
            }

        });
    </script>
@endsection
