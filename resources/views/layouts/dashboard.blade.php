<!doctype html>
<html lang="tr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

@yield('meta')

@yield('title')

<!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/img/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/icon/favicon-16x16.png">
    <link rel="manifest" href="/img/icon/site.webmanifest">
    <link rel="mask-icon" href="/img/icon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#f8f8f8">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.v1.1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

    @yield('css')

</head>
<body>
<div id="app">

    <main>
        <section class="section-dashboard">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="d-flex" id="dashboard-wrapper">

                <!-- Sidebar -->
                <div class="bg-light border-right" id="dashboard-sidebar-wrapper">
                    <div class="sidebar-heading">
                        MUHYAR
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('users.index') }}"
                           class="list-group-item list-group-item-action bg-light {{ preg_match("/users/i", Request::path()) ? 'active' : '' }}">
                            Ekip Üyeleri
                        </a>
                        <a href="{{ route('competitions.dindex') }}"
                           class="list-group-item list-group-item-action bg-light {{ preg_match("/yarisma/i", Request::path()) ? 'active' : '' }}">
                            Yarışmalar
                        </a>
                        <a href="{{ route('announcements.dindex') }}"
                           class="list-group-item list-group-item-action bg-light {{ preg_match("/duyuru/i", Request::path()) ? 'active' : '' }}">
                            Duyurular
                        </a>
                        <a href="{{ route('contents.dindex') }}"
                           class="list-group-item list-group-item-action bg-light {{ preg_match("/icerik/i", Request::path()) ? 'active' : '' }}">
                            İçerikler
                        </a>
                        <a href="{{ route('publisher.index') }}"
                           class="list-group-item list-group-item-action bg-light {{ preg_match("/yazar/i", Request::path()) ? 'active' : '' }}">
                            Yazarlar
                        </a>
                    </div>
                </div>
                <!-- /#sidebar-wrapper -->

                <!-- Page Content -->
                <div id="dashboard-page-content-wrapper">

                    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                        <button id="menu-toggle">
                            <i class="fas fa-bars"></i>
                        </button>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                                @auth()
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('users.profile', auth()->id()) }}">
                                            <img class="rounded-circle z-depth-0" src="{{ asset('storage/'. auth()->user()->photo) }}">
                                            <span class="sr-only">(current)</span>
                                        </a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </nav>

                    <div class="container-fluid">
                        @yield('contents')
                    </div>
                </div>

            </div>
        </section>



    </main>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('script.v1.js') }}"></script>
<script src="https://kit.fontawesome.com/e651d63672.js" crossorigin="anonymous"></script>
@yield('scripts')
</body>
</html>
