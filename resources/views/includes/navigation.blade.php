<nav id="sticky-nav" class="sticky {{ Request::path() ==  '/' ? 'd-none' : ''  }}">
    <div class="row">
        <a href="{{ route('home') }}" class="mr-auto">
            <img src="{{ asset('img/favicon.png') }}" alt="Mühendislik Yarışmaları" class="header__logo-black">
        </a>
        <ul class="main-nav js--main-nav">
            <li><a class="mainlink" href="{{ route('home') }}">Anasayfa</a></li>
            <li><a class="mainlink" href="{{ route('competitions.index') }}">Yarışmalar</a></li>
            <li><a class="mainlink" href="{{ route('contents.index') }}">İçerikler</a></li>
            <li><a class="mainlink" href="{{ route('announcements.index') }}">Duyurular</a></li>
        </ul>
        <a class="mobile-nav-icon js--nav-icon"><i class="icon fas fa-bars"></i></a>
    </div>
</nav>
