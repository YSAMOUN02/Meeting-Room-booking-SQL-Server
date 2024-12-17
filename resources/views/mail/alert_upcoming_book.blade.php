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

            <div class="flex">
                <img height="200px" src="{{URL('assets/image/Logo_PPM.jpg')}}"  alt="PPM Logo" />
            </div>
            {{-- <h3>Now {{$mailData['now']}} </h3> --}}
            <h3>Dear Ms./Mrs. {{$mailData['fullName']}}.</h3>
            <h3>Your Schedule meeting is Upcoming. Be prepare for this.</h3>
            <h3>Room : {{$mailData['room']}}</h3>
            <h3>Topic: {{$mailData['topic']}}</h3>
            <h3>Today  From: {{\Carbon\Carbon::parse($mailData['start_time'])->format('h:i A')}}  To   {{\Carbon\Carbon::parse($mailData['end_time'])->format('h:i A')}}</h3>

            <p>Click Link Below to login in to system</p>
            <a href="{{$mailData['url']}}">{{$mailData['url']}}</a>
            <p style="color: red">(Support PPM Local Network only)</p>





    </main>


</body>
</html>
