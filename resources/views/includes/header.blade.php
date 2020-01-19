<header class="header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <nav>
        <div class="row">
            <a href="{{ route('home') }}" style="margin-right: auto;">
                <img src="{{ url('img/favicon.png') }}" alt="Mühendislik Yarışmaları" class="header__logo">
            </a>
            <ul class="main-nav js--main-nav">
                <li><a class="mainlink" href="{{ route('competitions.index') }}">Yarışmalar</a></li>
                <li><a class="mainlink" href="{{ route('contents.index') }}">İçerikler</a></li>
                <li><a class="mainlink" href="{{ route('announcements.index') }}">Duyurular</a></li>
            </ul>
            <a class="mobile-nav-icon js--nav-icon"><i class="icon fas fa-bars"></i></a>
        </div>
    </nav>
    <div class="container text-center content--carousel">
        <div class="row mx-auto my-auto">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ route('contents.link', $first[0]->link) }}">
                                <img class="img-fluid" src="{{ URL::asset($first[0]->cover) }}" alt="$first[0]->series_name">
                            </a>
                        </div>
                    </div>
                        @foreach($series as $item)
                            <div class="carousel-item">
                                <div class="col-lg-4 col-md-6">
                                    <a href="{{ route('contents.link', $item->link) }}">
                                        <img class="img-fluid" src="{{ URL::asset($item->cover) }}" alt="{{ $item->series_name }}">
                                    </a>
                                </div>
                            </div>
                        @endforeach

                </div>
                <a class="carousel-control-prev bg-dark w-auto" style="height: 98.4%;" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next bg-dark w-auto" style="height: 98.2%;" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</header>
