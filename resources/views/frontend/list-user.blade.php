
@extends('frontend.master')
@section('content')
<div id="popup-modal"  tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <form action="/user/delete/submit" method="post">
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
<div id="toast_search_delete">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

        <div class="p-4 md:p-5 text-center">
            <form action="/user/delete/submit" method="post">
                @csrf
                <input type="text" id="value_delete_via_search" name="id">
            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this user ?</h3>
            <button   type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                Yes, I'm sure
            </button>
            <button onclick="close_div('toast_search_delete')" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
            </form>
        </div>
    </div>
</div>
<div id="toast_search_update">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <button onclick="close_div('toast_search_update')" type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal2">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
        <div class="p-4 md:p-5">
            <form action="/user/update/submit" method="POST">
                @csrf
                <div class="w-full grid gap-6 mb-6  grid-cols-2 md:grid-cols-2">
                    <div>
                        <label for="first_name2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" id="first_name2" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                    </div>

                    <div>
                        <label for="company2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
                        <select id="company2" name="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="PPM">PPM</option>
                            <option value="CFR">CFR</option>
                            <option value="INV">INV</option>
                            <option value="other">Other</option>
                        </select>
                        <input type="text" class="hidden" name="id" id="id2">
                    </div>
                    <div>
                        <label for="department2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                        <select id="department2"  name="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose Department</option>
                            <option value="Accounting & Finance">Accounting & Finance</option>
                            <option value="Administration & HR">Administration & HR</option>
                            <option value="Commercial">Commercial</option>
                            <option value="Consultant">Consultant</option>
                            <option value="Export and Marketing">Export and Marketing</option>
                            <option value="External Project & Special Project">External Project & Special Project</option>
                            <option value="Logistic">Logistic</option>
                            <option value="Maintenance">Maintenance</option>
                            <option value="Management">Management</option>
                            <option value="Marketing">Marketing</option>
                            <option value="MIS">MIS</option>
                            <option value="Planning">Planning</option>
                            <option value="Production">Production</option>
                            <option value="Purchase">Purchase</option>
                            <option value="Quality Assurance">Quality Assurance</option>
                            <option value="Quality Control">Quality Control</option>
                            <option value="Quality Management">Quality Management</option>
                            <option value="Regulatory Affairs">Regulatory Affairs</option>
                            <option value="Research & Development">Research & Development</option>
                            <option value="Research and Development">Research and Development</option>
                            <option value="Warehouse">Warehouse</option>

                            <option value="Other">Other</option>

                        </select>
                    </div>
                    @if(Auth::user()->role == 'admin')
                    <div>
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role </label>

                            <select id="role2" name="role" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="user" selected>User</option>
                                <option value="admin">Admin</option>

                            </select>

                    </div>
                    @endif
                    <div>
                        <label for="phone2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone number</label>
                        <input type="phone" id="phone2" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                    </div>
                    <div>
                        <label for="id_card2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Card</label>
                        <input type="text" id="id_card2" name="id_card" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                    </div>


                </div>
                <div class="mb-6">
                    <label for="email2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
                    <input type="email" id="email2" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="jonh@gamil.com" />
                </div>
                <div class="mb-6">
                    <label for="user_login2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Login</label>
                    <input type="text" id="user_login2" name="user_login" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="..." />
                </div>
                @if (Auth::user()->role == 'admin')
                <div class="mb-6">
                    <label for="password2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" id="password2"  name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="..." />
                </div>

                <div class="mb-6">
                    <span>Show Password</span>
                    <input type="checkbox" onchange="show_password2()">
                </div>

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                @endif
            </form>
        </div>
    </div>
</div>
<div id="popup-modal2"  tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal2">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5">
                <form action="/user/update/submit" method="POST">
                    @csrf
                    <div class="w-full grid gap-6 mb-6  grid-cols-2  md:grid-cols-2">
                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" id="first_name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        </div>

                        <div>
                            <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
                            <select id="company" name="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="PPM">PPM</option>
                                <option value="CFR">CFR</option>
                                <option value="INV">INV</option>
                                <option value="other">Other</option>
                            </select>
                            <input type="text" class="hidden" name="id" id="id">
                        </div>
                        <div>
                            <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                            <select id="department"  name="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Choose Department</option>
                                <option value="Accounting & Finance">Accounting & Finance</option>
                                <option value="Administration & HR">Administration & HR</option>
                                <option value="Commercial">Commercial</option>
                                <option value="Consultant">Consultant</option>
                                <option value="Export and Marketing">Export and Marketing</option>
                                <option value="External Project & Special Project">External Project & Special Project</option>
                                <option value="Logistic">Logistic</option>
                                <option value="Maintenance">Maintenance</option>
                                <option value="Management">Management</option>
                                <option value="Marketing">Marketing</option>
                                <option value="MIS">MIS</option>
                                <option value="Planning">Planning</option>
                                <option value="Production">Production</option>
                                <option value="Purchase">Purchase</option>
                                <option value="Quality Assurance">Quality Assurance</option>
                                <option value="Quality Control">Quality Control</option>
                                <option value="Quality Management">Quality Management</option>
                                <option value="Regulatory Affairs">Regulatory Affairs</option>
                                <option value="Research & Development">Research & Development</option>
                                <option value="Research and Development">Research and Development</option>
                                <option value="Warehouse">Warehouse</option>

                                <option value="Other">Other</option>


                                <!-- Add other departments as needed -->
                            </select>
                        </div>
                        @if(Auth::user()->role == 'admin')
                        <div>
                            <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role </label>

                                <select id="role" name="role" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="user" selected>User</option>
                                    <option value="admin">Admin</option>

                                </select>

                        </div>
                        @endif
                        <div>
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone number</label>
                            <input type="phone" id="phone" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                        </div>
                        <div>
                            <label for="id_card" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Card</label>
                            <input type="text" id="id_card" name="id_card" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                        </div>


                    </div>
                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
                        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="jonh@gamil.com" />
                    </div>
                    <div class="mb-6">
                        <label for="user_login" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Login</label>
                        <input type="text" id="user_login" name="user_login" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="..." />
                    </div>
                    @if (Auth::user()->role == 'admin')
                    <div class="mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" id="password"  name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="..." />
                    </div>

                    <div class="mb-6">
                        <span>Show Password</span>
                        <input type="checkbox" onchange="show_password() ">
                    </div>

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
<section class="drop_slow1 bg-gray-50 dark:bg-gray-900">
    <div  class="w-full">
        <div class="w-full phone_respond flex justify-between p-2">

            <div id="search">
                <select  id="type">
                    <option value="name">Name</option>
                    <option value="id">ID</option>

                    <option value="id_card">ID Card</option>
                    <option value="company">Company</option>
                    <option value="department">Department</option>
                    <option value="email">Email</option>
                    <option value="role">Role</option>
                    <option value="phone">Phone</option>
                </select>
                <input type="text" id="value" >
                <button onclick="search_user(1)" id="btn_search" ><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="p-2 text-center">
                <kbd id="total_user" class="px-4 py-1.5 text-lg font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Total : {{$total_record}} User</kbd>

            </div>
        </div>

        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

            <div  class="table_user_container overflow-x-auto">
                <table class="standard-table table  w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="  text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr >
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">ID</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Name</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">ID Card</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Company</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Department</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Email</th>
                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Role</th>
                            <th scope="col" class="ppx-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">Phone</th>

                            <th scope="col" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody id="users_tbody">
                        @if(!empty($user))
                            @php
                                $index = 0;
                            @endphp
                            @foreach ($user  as $item )
                                <tr class="border-b dark:border-gray-700">
                                    <td scope="row" class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->id}}</td>

                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{$item->name}}</td>
                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{$item->id_card}}</td>
                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{$item->company}}</td>
                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{$item->department}}</td>
                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{$item->email}}</td>
                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{$item->role}}</td>
                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3">{{$item->phone}}</td>
                                    <td class="px-3 py-3 md:px-4 md:py-3 lg:px-4 lg:py-3" >
                                        <button type="button" onclick="edit_user({{$index}})"  data-modal-target="popup-modal2"   data-modal-toggle="popup-modal2" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-4 py-1 text-center me-2 mb-2 md:px-5 md:py-2.5 ">
                                           @if (Auth::user()->role == 'admin')
                                           <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                           @else
                                           <i class="fa-solid fa-eye" style="color: #ffffff;"></i>

                                           @endif


                                        </button>
                                        @if (Auth::user()->role == 'admin')
                                        <button type="button"  onclick="delete_id({{$item->id}})"  data-modal-target="popup-modal" data-modal-toggle="popup-modal"  class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-4 py-1 text-center me-2 mb-2 md:px-5 md:py-2.5"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
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
    </section>

    <script>
        let users = @json($user);
        let auth = @json(Auth::user());
        const button = document.querySelector('#btn_search');

        // id="search_button"
        document.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            button.click();
        }
        });
    </script>
@endsection
