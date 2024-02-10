<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $data['title'] }}</title>
    <link rel="stylesheet" href="{{ asset('cssfile/style.css') }}">
    <style>
        .mailbackground {
            background: gray;
            padding: 50px;
            text-align: center;
        }

        .mailmessage {
            padding: 50px;
            font-size: 18px;

        }
    </style>
</head>

<body>
    <div class="mailbackground">
        <h1>your OTP is :- </h1>
        <div class='mailmessage'>

            {{ $data['body'] }}

        </div>

        <br>
        <p>Thank You!</p>
    </div>


</body>

</html>
