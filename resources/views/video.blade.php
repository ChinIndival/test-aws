<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            var getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
            var cameraStream;

            getUserMedia.call(navigator, {
                video: true,
                audio: true //optional
            }, function (stream) {
                /*
                Here's where you handle the stream differently. Chrome needs to convert the stream
                to an object URL, but Firefox's stream already is one.
                */
                if (window.webkitURL) {
                    video.src = window.webkitURL.createObjectURL(stream);
                } else {
                    video.src = stream;
                }

                //save it for later
                cameraStream = stream;

                video.play();
            });
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('logout') }}">Logout</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Video Chat Rooms
                </div>

                {!! Form::open(['url' => 'room/create']) !!}
                    {!! Form::label('roomName', 'Create or Join a Video Chat Room') !!}
                {!! Form::text('roomName') !!}
                {!! Form::submit('Go') !!}
                {!! Form::close() !!}

                @if($rooms)
                @foreach ($rooms as $room)
                    <a href="{{ url('/room/join/'.$room) }}">{{ $room }}</a>
                @endforeach
                @endif
            </div>
        </div>
    </body>
</html>