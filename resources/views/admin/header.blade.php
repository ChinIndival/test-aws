<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                プロジェクト
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <div class="row" style="position: absolute; left: 600px;">
{{--                            <a class="nav-link" href="{{ route('users.index') }}">{{ __('ユーザーリスト') }}</a>--}}
{{--                            <a class="nav-link" href="{{ route('positions.index') }}">{{ __('部分') }}</a>--}}
{{--                            <a class="nav-link" href="{{ route('chat') }}">{{ __('Chat') }}</a>--}}
                        </div>
{{--                        <form role="search" method="get" id="searchform" action="{{ route('search') }}" class="form">--}}
{{--                            <!-- <input name="cx" type="hidden"/> -->--}}
{{--                            <!-- <input value="FORID:11" name="cof" type="hidden"/> -->--}}
{{--                            <input type="text" value="" name="key" id="s" placeholder="キーワードを入力してください" size="40px" required />--}}
{{--                            <button type="submit" class="button1">探索</button>--}}
{{--                        </form>--}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
