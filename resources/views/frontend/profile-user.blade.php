
@extends('frontend.master')
@section('content')
<form action="/user/update/profile/submit" method="POST">
    @csrf
    <div class="w-full grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
            @if (!empty($user->name))
            <input type="text" id="first_name" disabled  value="{{$user->name}}" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            @else
            <input type="text" id="first_name"  disabled   name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            @endif

        </div>

        <div>
            <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
            <select id="company" name="company" disabled  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @if (!empty($user->company))

                <option value="{{$user->company}}">{{$user->company}}</option>
                @endif
                <option value="Investco">Investco</option>
                <option value="PPM">PPM</option>
                <option value="Confirel">Confirel</option>
                <option value="Depomix">Depomix</option>
            </select>
            @if (!empty($user->company))
                <input type="text" class="hidden" name="id" id="id" value="{{$user->id}}">
            @else
            <input type="text" class="hidden" name="id" id="id" value="{{$user->id}}">
            @endif
        </div>
        <div>
            <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
            <select id="department" disabled   name="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @if (!empty($user->department))
                <option value="{{$user->department}}">{{$user->department}}</option>
                @endif
                <option value="Accounting">Accounting</option>
                <option value="Admin">Admin</option>
                <option value="Comercail">Commercial</option>
                <option value="Design">Design</option>
                <option value="Export">Export</option>
                <option value="HR">HR</option>
                <option value="Finance">Finance</option>
                <option value="IT">IT</option>
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
        @if(Auth::user()->role == 'admin')
        <div>
            <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role </label>

                <select id="role" name="role" disabled  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @if (!empty($user->role))
                    <option value="{{$user->role}}" selected>{{$user->role}}</option>
                    @endif
                    <option value="user" >user</option>
                    <option value="admin">admin</option>

                </select>

        </div>
        @endif
        <div>
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone number</label>
            @if (!empty($user->phone))
            <input type="phone" disabled  value="{{$user->phone}}" id="phone" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />

            @else
            <input type="phone" disabled  id="phone" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
            @endif

        </div>
        <div>
            <label for="id_card" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Card</label>
            @if (!empty($user->id_card))
            <input type="text" disabled  id="id_card" value="{{$user->id_card}}" name="id_card" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
            @else
            <input type="text" disabled  id="id_card" name="id_card" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />

            @endif
        </div>


    </div>
    <div class="mb-6">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>

        @if (!empty($user->email))
        <input type="email" disabled  value="{{$user->email}}" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="jonh@gamil.com" />
        @else
        <input type="email" disabled  id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="jonh@gamil.com" />

        @endif

    </div>
    <div class="mb-6">
        <label for="user_login" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Login</label>
        @if (!empty($user->user_login))
        <input type="text"  value="{{$user->user_login}}" id="user_login" name="user_login" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="..." />
        @else
        <input type="text"   id="user_login" name="user_login" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="..." />
        @endif
    </div>

    <div class="mb-6">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
        <input type="password"  id="password"  name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="..." />
    </div>

    <div class="mb-6">
        <span class="text-rose-600">You can only change password and user login. if you want to change other information contact admin of the system.</span><br>
        <span>Show Password</span>
        <input type="checkbox" onchange="show_password() " id="">
    </div>

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

</form>
@endsection
