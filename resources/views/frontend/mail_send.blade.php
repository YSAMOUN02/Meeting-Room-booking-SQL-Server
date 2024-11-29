<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- LINK CSS  --}}
    {{-- <link rel="stylesheet" href="{{URL('assets/css/style.css')}}"> --}}

    {{-- ICON WEBSITE --}}

    <title>Meeting Room System</title>
    <style>
        *{
            margin: 0;
            box-sizing: border-box;
        }
        .main_mail{
            width: 100%

        }

    </style>
</head>
<body>



    <main class="main_mail">
        <h3>The System has recieved Reset Password request. New password below:</h3>

        <h1>{{$mailData['temp_password']}}</h1>
        <p>Name : {{$mailData['fullName']}}</p>
        <p>Company : {{$mailData['company']}}</p>
        <p>Department: {{$mailData['department']}}</p>
        <p>Phone : {{$mailData['phone']}}</p>
        <p>Email : {{$mailData['email']}}</p>
        <p>Click Link Below to quick sign in</p>
        <a href="{{$mailData['url']}}">{{$mailData['url']}}</a>

    </main>


</body>
</html>
