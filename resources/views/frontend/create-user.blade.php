
@extends('frontend.master')
@section('content')

<form action="/user/create/submit" method="POST">
    @csrf
    <div class="w-full grid gap-6  md:grid-cols-2 bg-gray-400 p-4">
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 ">First name</label>
            <input type="text" id="first_name" name="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        </div>
        <div>
            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 ">Last name</label>
            <input type="text" id="last_name" name="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required />
        </div>
        <div>
            <label for="company" class="block mb-2 text-sm font-medium text-gray-900 ">Company</label>
            <select id="company" name="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="PPM">PPM</option>
                <option value="CFR">CFR</option>
                <option value="INV">INV</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div>
            <label for="department" class="block mb-2 text-sm font-medium text-gray-900 ">Department</label>
            <select id="department"  name="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="Other" selected>Choose Department</option>
                <option value="Accounting & Finance">Accounting & Finance</option>
                <option value="Administration & HR">Administration & HR</option>
                <option value="Commercial">Commercial</option>
                <option value="Consultant">Consultant</option>
                <option value="Digital Marketing">Digital Marketing</option>
                <option value="Export and Marketing">Export and Marketing</option>
                <option value="External Project & Special Project">External Project & Special Project</option>
                <option value="Farm">Farm</option>
                <option value="INV External Project Villa">INV External Project Villa</option>
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
                <option value="Quality Production">Quality Production</option>
                <option value="Regulatory Affairs">Regulatory Affairs</option>
                <option value="Research & Development">Research & Development</option>
                <option value="Research and Development">Research and Development</option>
                <option value="Warehouse">Warehouse</option>
                <option value="Water Bank Cooperative">Water Bank Cooperative</option>

                <option value="Other">Other</option>

                <!-- Add other departments as needed -->
            </select>
        </div>
        <div>
            <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role </label>

                <select id="role" name="role" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="user" selected>User</option>
                    <option value="admin">Admin</option>

                </select>

        </div>
        <div>
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">Phone number</label>
            <input type="phone" id="phone" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
        </div>
        <div>
            <label for="id_card" class="block mb-2 text-sm font-medium text-gray-900 ">ID Card</label>
            <input type="text" id="id_card" name="id_card" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
        </div>


    </div>
    <div class="bg-gray-400 p-4">
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email address</label>
            <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="jonh@gamil.com" />
        </div>
        <div class="mb-6">
            <label for="user_login" class="block mb-2 text-sm font-medium text-gray-900">User Login</label>
            <input type="text" id="user_login" name="user_login" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="..." />
        </div>
        <div class="mb-6">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
            <input type="password" id="password" name="password" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="..." />
        </div>
        <div class="mb-6">
            <input type="checkbox" onchange="show_password()" id="d">
            <label for="d">Show Password</label>
        </div>
        <div class="mt-6">
            <button type="submit" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </div>
    </div>


</form>


@endsection
