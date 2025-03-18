
@extends('frontend.master')
@section('content')

<form action="/room/create/submit" method="POST" enctype="multipart/form-data" >
    @csrf
    <div class="w-full grid gap-6 mb-6 md:grid-cols-1">
        <div>
            <label for="room_name" class="block mb-2 text-sm font-medium text-gray-900">Room Name</label>
            <input type="text" id="room_name" name="room_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        </div>
        <div>
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Room Description</label>
            <input type="text" id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required />
        </div>
        <div>
            <label for="seat" class="block mb-2 text-sm font-medium text-gray-900">Qty Seat</label>
            <input type="number" id="seat" name="seat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required  placeholder="number only"/>
        </div>
        <div>
            <label for="thumbnail" class="block mb-2 text-sm font-medium text-gray-900 ">Thumbnail Room</label>
            <input type="file" id="imageInput" name="thumbnail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required />
        </div>
        <img id="preview" src="" required alt="Image Preview" style="display: none; max-width: 300px;">
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>

<script>
       const imageInput = document.getElementById('imageInput');
       const preview = document.getElementById('preview');
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
