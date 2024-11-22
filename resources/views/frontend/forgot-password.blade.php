<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/5041c59df8.js" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="{{ URL('assets/image/office.ico') }}" type="image/x-icon">

    <style>
        .body {
            min-height: 100vh;
            background: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQULsBdVBrYBEmQyb3ayNIZ5eRvCSR40Xqlvw&s');
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
            position: relative;
        }

        #btn_login, #send {
            background-color: green;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
        }

        .alert {
            position: fixed;
            top: 100px;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 999;
        }

        .alert_style {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgb(255, 255, 255);

            z-index: 9999 !important;
            padding: 5px 20px;
            border-radius: 10px;

            animation: fade 30s forwards;
        }

        .fail {
            color: rgb(255, 74, 74);
            border: 1px solid rgb(241, 62, 62);
        }

        .success {
            color: rgb(0, 113, 11);
            border: 1px solid rgb(2, 103, 0);
        }

        .alert_style i {
            margin-right: 5px;
        }

        .drop_slow1 {
            animation: drop_slow 1s forwards;
        }

        .drop_slow2 {
            animation: drop_slow 2s forwards;
        }

        #toast {
            position: absolute;
            top: 40px;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: fade 10s forwards;
            z-index: 9999;
            display: none

        }
        #loading_style{
    width: 200px;
    height: 100px;
    position: fixed;
    top: 20%;
    left: 50%;
    transform: translate(-50%,-50%);
    z-index: 99;
    backdrop-filter: blur(10px);
    background-color: black;
    color: white;

  }
  #loading h1{
    margin: 0 10px;
  }
  #code{
    display: none;
  }
        @keyframes fade {
            0% {
                display: block;

            }

            100% {

                display: none;
            }
        }

        @keyframes drop_slow {
            0% {
                transform: translateY(-10px);
                opacity: 0;
                display: block;
            }

            100% {
                transform: translateY(0px);
                opacity: 1;
                display: none;
            }
        }
    </style>
    <title>Login</title>

</head>

<body>
    <div id="toast"
        class="max-w-xs bg-white border border-gray-200 rounded-xl shadow-lg dark:bg-neutral-800 dark:border-neutral-700"
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
                    Success
                </p>
            </div>
        </div>
    </div>
    @if (session('fail'))
    <div class="drop_slow1 alert fail alert-success">
        <div class="alert_style">
            <i class="fa-solid fa-circle-exclamation" style="color: #ff0000;"></i>
            {{ Session::get('fail') }}
        </div>
    </div>
@endif
    @if (session('success'))
        <div class=" drop_slow1 alert success alert-success">
            <div class="alert_style">
                <i class="fa-solid fa-circle-exclamation" style="color: #34ad00;"></i>
                 {{ Session::get('success') }}

            </div>
        </div>
    @endif

    <section class="body bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Enter Your user or Email to Reset your Password
                    </h1>
                    <form class="space-y-4 md:space-y-6" id="form_login" action="/login/submit" method="POST">
                        @csrf
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User or email</label>
                            @if(!empty($username))
                                <input type="text" name="name_email" id="name_email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@company.com" required="" value="{{$username}}">
                            @else
                                <input type="text" name="name_email" id="name_email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@company.com" required="">
                            @endif

                        </div>
                        <div>
                            <button type="button" id="send" onclick="find_name_email()">Send Code</button>
                        </div>


                        <div id="code" >
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code</label>
                            @if (!empty($code))
                            <input type="text" name="password" id="password" value="{{$code}}"
                            class=" bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required="">
                            @else
                            <input type="text" name="password" id="password"
                            class=" bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required="">

                            @endif
                            <div class="flex items-center justify-between">

                            </div>
                                <button type="button" id="btn_login" class="mt-2" onclick="submit_with_api()">Login</button>
                        </div>
                        <div class="flex justify-between">
                            <div></div>
                            <a href="/login"
                            class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">
                            sign in?</a>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </section>
    <div id="loading">
        <div  id="loading_style" class="flex items-center justify-center w-56 h-56 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700 ">
            <div role="status">
                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>

            </div>
            <h1>Loading ....</h1>
        </div>

    </div>
    <script>
        let user_name = @json($username);
        let code = @json($code);

        const button = document.querySelector('#btn_login');

            // id="search_button"
            document.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                button.click();
            }
            });

        if(user_name != ''){
                document.getElementById("code").style.display = 'block';
                document.getElementById("send").textContent = 'Send Again?'
                if(code != ''){

                    document.querySelector("#btn_login").click();
                }
        }
         async function find_name_email() {
        try {
            document.querySelector("#loading").style.display = 'block';

        const response = await fetch('/api/check/name', {
                method: 'POST',
                headers: {
            'Content-Type': 'application/json'
        },
            body: JSON.stringify({
                name_email: document.getElementById('name_email').value,
            }),
        });

            const data = await response.json();

            if (response.ok) {
                if(data){
                    if(data.status == 'success'){
                    alert(data.message);
                    document.getElementById("code").style.display = 'block';
                    document.getElementById("send").textContent = 'Send Again?'
                    document.querySelector("#loading").style.display = 'none';
                    }
                }else{
                    alert("Operation fail.");
                    document.querySelector("#loading").style.display = 'none';
                }

            } else {
                document.querySelector("#loading").style.display = 'none';
                alert("Invalid Email or Name.");

            }
            } catch (error) {
                document.querySelector("#loading").style.display = 'none';
                alert("Problem connection to database.");

        }
    }

        async function submit_with_api() {
            try {
                document.querySelector("#loading").style.display = 'block';

                const response = await fetch('/api/login/submit', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name_email: document.getElementById('name_email').value,
                        password: document.getElementById('password').value,
                        remember: false,
                    }),
                });

                const data = await response.json();
                let tost = document.getElementById('toast');
                let label = document.querySelector("#hs-toast-warning-example-label");
                console.log(data);
                if (response.ok) {
                    document.querySelector("#loading").style.display = 'none';
                    if (response.status ==200){
                        if (data.token) {

                                localStorage.setItem('token', data.token); // Store the token if present
                                document.getElementById('form_login').submit();

                        } else {
                            alert('No token');
                        }
                    }else if(response.status == 401){
                        // alert('Invalid Credentail.');
                        label.innerHTML = `Invalid Credentail.`;
                        tost.style.display = 'block';
                    }else if(response.status == 404){
                        label.innerHTML = `Page Not found.`;
                        tost.style.display = 'block';

                    }else{
                        label.innerHTML = `No Respond.`;
                        tost.style.display = 'block';
                    }


                }else{
                    document.querySelector("#loading").style.display = 'none';
                    alert("Invalid Credentail.");

                }
            } catch (error) {
                document.querySelector("#loading").style.display = 'none';

                alert(error);

            }
            document.querySelector("#loading").style.display = 'none';
        }
    </script>
    <script src="{{ URL('assets/js/script.js') }}"></script>
</body>

</html>
