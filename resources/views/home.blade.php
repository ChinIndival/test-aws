@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Session::has('uploadSuccess'))
                        <div class="alert alert-success">{{Session::get('uploadSuccess')}}</div>
                    @endif
                    You are logged in!
                    <a href="{{ route('chat') }}">Chat</a>
                    or
                    <a href="{{ route('video') }}">Video Call</a>
                    <hr>
                    <form method="POST" action="{{ route('file_store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-2 offset-md-0">
                            <input type="file" name="img" class="file" accept="image/*" required>
                        </div>
                        <br>
                        <div class="col-md-10">
                            <div class="col-md-6 offset-md-0">
                                <button type="reset" class="btn btn-warning">
                                    {{ __('リセット') }}
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('新規追加') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
