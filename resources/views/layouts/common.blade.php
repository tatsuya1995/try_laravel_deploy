<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('/assets/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('/assets/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('index') }}">
                <img src="{{ asset('/assets/image/logo.png') }}" width="400px">
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
                        <li class="nav-item">
                                <a class="nav-link" href="{{('/index')}}">{{ __('サービス説明') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{'/select'}}">{{ __('ログイン/新規登録') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{'/qa'}}">{{ __('Q＆A') }}</a>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer class="footer text-center">
        <address>
        このホームページに関するお問合せ先<br>
        Eメール：<a href="">info@car.com</a><br>
        ＴＥＬ：<a href="tel:0123-435-678">0123-435-678</a><br>
        住所：〒1234-5678　福岡県○○市○○町1-2-3<br>
        営業時間:09:00〜22:00
        </address> 
        <small>Copyright &copy;2020 Car.マッチング</small>
    </footer>
</body>
</html>
