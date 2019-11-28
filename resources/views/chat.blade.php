@extends('admin.master')

@section('title', 'Chat')

@section('content')
    <div class="mmm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">ホームページ </a></li>
                        <li>&nbsp/&nbsp</li>
                        <li><a><u></a>Chat</u></li>
                    </ul>
                    @if(Session::has('deleteSuccess'))
                        <div class="alert alert-success">{{Session::get('deleteSuccess')}}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <h3>Chat</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card" id="overflowTest">
                                <div id="tt" class="ml-6 col-sm-12">
                                    @foreach($messages as $value)
                                        <p id="mm" @if($value->user->id == Auth::user()->id) style="background-color: #d2f0ff" @endif>
                                            @if($value->user->id == Auth::user()->id)
                                        
                                                {{ $value->created_at->format('Y-m-d | H:m:s') }} - (本人): {{ $value->message }}
                                            @else
                                                {{ $value->created_at->format('Y-m-d | H:m:s') }} - <i>{{ $value->user->name }}:</i> {{ $value->message }}
                                            @endif
                                            @if($value->user->id == Auth::user()->id)
                                                <a href="" data-url="{{ route('messages.destroy', $value->id) }}" id="message_id" data-toggle="modal" data-target="#modal-example" style="color: red" >(削除)</a>
                                            @endif
                                            <hr>
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <input id="message" class="form-control" placeholder="Type a message">
                                {{csrf_field()}}
                            <input id="user_id" type="hidden" class="form-control" value="{{ Auth::user()->id }}">
                            <br>
                            <button id="send_chat" type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                    <div class="modal fade" id="modal-example" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modal-label">確認</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" id="modal-delete-form">
                                    @method('delete')
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="modal-body">選択した情報を削除します。よろしいですか？</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                        <button type="submit" class="btn btn-primary" id="modal-delete">削除実行</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#overflowTest').animate({
                scrollTop: $('#overflowTest').get(0).scrollHeight
            }, 0);
        });
        $(document).on("click", "#message_id", function () {
            var url = $(this).data('url')
            $("#modal-delete-form").attr("action", url);
        });

        $(document).on('click', '#send_chat', function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var user_id = $('#user_id').val();
            var message = $('#message').val();

            $.ajax({
                url: "/store",
                method: "POST",
                data: { _token: CSRF_TOKEN, user_id: user_id, message: message},

                success: function (response) {
                    $(".mmm").html(response.html);
                },
                error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                    console.log(JSON.stringify(jqXHR));
                    alert('deo dc')
                }
            });
        });

        // Pusher.logToConsole = true;
        var pusher = new Pusher('e2a3a474d20c1be3a032', {
            cluster: "ap3",
            useTLS: true
        });
        // alert('Dd');

        var channel = pusher.subscribe('notify');
        channel.bind('pusher:subscription_succeeded', function(members) {
            // alert('successfully subscribed!');
        });
        channel.bind('App\\Events\\Notify', function (data) {
            var html = `
              <p id="mm">`+data.time+`&nbsp-&nbsp<i>`+data.user+`</i>:&nbsp`+data.message+`</p>
            `;
            $('#tt').append(html);
        });


        // alert('Dd');

        var channel2 = pusher.subscribe('rep_mess');
        channel2.bind('pusher:subscription_succeeded', function(members) {
            // alert('successfully subscribed!');
        });
        channel2.bind('App\\Events\\RepMess', function (data) {
            var html = `
              <p id="mm">`+data.time+`&nbsp-&nbsp<i>`+data.user+`</i>:&nbsp`+data.rep_mess+`</p>
            `;
            $('#tt').append(html);
        });
    </script>

@endsection
