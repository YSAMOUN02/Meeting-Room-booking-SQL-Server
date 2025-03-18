<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')




    <link rel="stylesheet" href="{{URL('assets/fonts6/css/all.css')}}">

    <link rel="stylesheet" href="{{ URL('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ URL('assets/image/office.ico') }}" type="image/x-icon">
    <title>Meeting-Room-Booking</title>

</head>

<body>

    <div id="toast"
        class="max-auto bg-white border border-gray-200 rounded-xl shadow-lg dark:bg-neutral-800 dark:border-neutral-700"
        role="alert" tabindex="-1" aria-labelledby="hs-toast-warning-example-label">
        <div class="flex p-4">
            <div class="shrink-0">
                <svg class="shrink-0 size-4 fill-red-800 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z">
                    </path>
                </svg>
            </div>
            <div class="ms-3">
                <p id="hs-toast-warning-example-label" class="text-sm text-gray-700 dark:text-neutral-400">

                </p>
            </div>
        </div>
    </div>
    <div id="popup-modal3" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                <div class="p-4 md:p-5 text-center">


                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to Log
                        out ?</h3>
                    <a href="/logout">
                        <button
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Yes, I'm sure
                        </button>
                    </a>
                    <button data-modal-hide="popup-modal3" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                        cancel</button>

                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="alert success alert-success">
            <div class="alert_style">
                <i class="fa-solid fa-circle-exclamation" style="color: #34ad00;"></i> {{ Session::get('success') }}

            </div>
        </div>
    @endif
    @if (session('fail'))
        <div class="alert fail alert-success">
            <div class="alert_style">
                <i class="fa-solid fa-circle-exclamation" style="color: #ff0000;"></i>
                {{ Session::get('fail') }}
            </div>
        </div>
    @endif

    <div id="loading">
        <div id="loading_style"
            class="flex items-center justify-center w-56 h-56 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700 ">
            <div role="status">
                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill" />
                </svg>

            </div>
            <h1>Loading ....</h1>
        </div>

    </div>

    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <nav
            class="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50">
            <div class="flex flex-wrap justify-between items-center">
                <div class="flex justify-start items-center">

                    @if (!empty(Auth::user()))
                        <button data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation"
                            aria-controls="drawer-navigation"
                            class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <svg aria-hidden="true" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Toggle sidebar</span>


                        </button>
                    @endif
                    <a href="/" class="flex items-center justify-between mr-4">
                        <img src="{{ URL('assets/image/Logo_PPM.jpg') }}" class="mr-3 h-8" alt="Flowbite Logo" />

                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">PPM Meeting
                            Room</span>
                    </a>
                    @if (empty(Auth::user()))
                        <div class="float_btn">
                            <a href="/login">

                                <button>Login</button>
                            </a>
                        </div>
                    @endif
                </div>
                <button id="dark-mode-toggle" class="p-2 rounded bg-gray-200 dark:bg-gray-800 text-black dark:text-white">
                    <i id="dark-mode-icon" class="fa-solid fa-sun"></i>
                </button>


            </div>
        </nav>

        <!-- Sidebar -->

        @if (!empty(Auth::user()))
            <aside
                class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
                aria-label="Sidenav" id="drawer-navigation">
                <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">

                    <ul class="space-y-2">
                        <li>
                            <a href="/"
                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <i class="fa-solid fa-house-laptop"></i>
                                <span class="ml-3">Meeting Room</span>
                            </a>
                        </li>
                        <li>
                            <a href="/list/room/booked"
                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span class="ml-3">Booked Room</span>
                            </a>
                        </li>
                        @if (!empty(Auth::user()))
                            @if (Auth::user()->role == 'admin')
                                <li>
                                    <a href="/list/history/booked/1"
                                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                        <i class="fa-solid fa-clock-rotate-left"></i>
                                        <span class="ml-3">Meeting History</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="/user/create"
                                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                        <i class="fa-solid fa-user-plus"></i>
                                        <span class="ml-3">Add User</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/list/user/1"
                                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                        <i class="fa-solid fa-users"></i>
                                        <span class="ml-3">List User</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/room/add"
                                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                        <i class="fa-solid fa-house-chimney-medical"></i>
                                        <span class="ml-3">Add Room</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="/room/list"
                                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                        <i class="fa-solid fa-house-circle-check"></i>
                                        <span class="ml-3">List Room</span>
                                    </a>
                                </li>
                            @endif
                        @endif

                        <li>
                            <a href="/user/profile"
                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <i class="fa-solid fa-user"></i>
                                <span class="ml-3">Your Profile</span>
                            </a>
                        </li>

                        {{-- <li>
                <a
                href="/user/send"
                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                >
                <i class="fa-solid fa-user"></i>
                <span class="ml-3">Register Mail</span>
                </a>
            </li> --}}
                        <li data-modal-target="popup-modal3" data-modal-toggle="popup-modal3"
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">



                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span class="ml-3">Log out</span>

                        </li>
                    </ul>

                </div>
    </div>
    </aside>
    @endif
    @if (!empty(Auth::user()))
        <main id="main" class="p-4 md:ml-64 h-auto pt-20">


            @yield('content')

        </main>
    @else
        <main id="main" style="margin: 0px;" class="p-4 md:ml-64 h-auto pt-20">


            @yield('content')

        </main>
    @endif
    </div>


    <script src="{{ URL('assets/js/flowbite.min.js') }}"></script>
    <link rel="stylesheet" href="{{URL('/assets/Icon/all.min.css')}}" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="{{ URL('assets/js/script.js') }}"></script>
    <script>
        let toast = document.querySelector("#toast");
        toast.addEventListener('click', () => {
            toast.style.display = 'none';
        })

        let button_dark = document.querySelector("#dark-mode-toggle");

        button_dark.addEventListener("click",()=>{
            updateButtonIcon("dark-mode-toggle");
            // localStorage.theme = "light";


        })


        localStorage.theme = "dark";

        // localStorage.removeItem("theme");

    // Function to update button icon based on theme
    function updateButtonIcon(button_id) {

        let button = document.querySelector("#"+button_id);



        if (button) {
            button.classList.replace("fa-sun", "fa-moon"); // Change to moon 🌙 in dark mode
        } else {
            button.classList.replace("fa-moon", "fa-sun"); // Change to sun 🌞 in light mode
        }

    }
    </script>


</body>

</html>
