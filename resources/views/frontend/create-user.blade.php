
@extends('frontend.master')
@section('content')

<form action="/user/create/submit" method="POST">
    @csrf
    <div class="w-full grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
            <input type="text" id="first_name" name="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        </div>
        <div>
            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
            <input type="text" id="last_name" name="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required />
        </div>
        <div>
            <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
            <select id="company" name="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Choose Company</option>
                <option value="Investco">Investco</option>
                <option value="PPM">PPM</option>
                <option value="Confirel">Confirel</option>
                <option value="Depomix">Depomix</option>
            </select>
        </div>
        <div>
            <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
            <select id="department"  name="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Choose Department</option>
                <option value="Accounting">Accounting</option>
                <option value="Admin">Admin</option>
                <option value="Comercail">Commercial</option>
                <option value="Design">Design</option>
                <option value="Export">Export</option>
                <option value="Finance">Finance</option>
                <option value="HR">HR</option>
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
        <div>
            <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role </label>

                <select id="role" name="role" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="user" selected>User</option>
                    <option value="admin">Admin</option>

                </select>

        </div>
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
    <div class="mb-6">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
        <input type="password" id="password" name="password" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="..." />
    </div>
    <div class="mb-6">
        <input type="checkbox" onchange="show_password()" id="d">
        <label for="d">Show Password</label>
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>


@endsection
