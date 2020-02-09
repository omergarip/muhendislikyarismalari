@extends('layouts.app')

@section('title')
    <title>Mühendislik Yarışmaları</title>
@endsection

@section('contents')
    @include('includes.header')
    @include('includes.navigation')



    <main>
        <section class="section-competitions js--section-competitions" id="competitions">
           
                <div class="u-center-text u-margin-bottom-big">
                    <h2 class="heading-secondary">
                        YARIŞMALAR
                    </h2>
                </div>
                <div class="js--wp-1">
                 @if($competitions->count() > 0)
                    <div class="row mx-auto u-margin-bottom-big">
                        @foreach($competitions as $competition)
                        <div class="col-lg-6 d-flex justify-content-around align-items-center">
                            <figure class="competitions">
                                <div class="competitions__hero">
                                    <a href="{{ route('competitions.show', $competition->slug) }}">
                                        <img src="{{ asset('storage/'.$competition->image) }}" alt="{{ $competition->title }}" class="competitions__img">
                                    </a>
                                </div>
                                <div class="competitions__content">
                                    <div class="competitions__title">
                                        <h1 class="competitions__heading u-center-text">{{ $competition->title }} </h1>
                                        <div class="tags competitions__tag">Yarışma</div>
                                    </div>

                                    <ul class="competitions__description">
                                        <li>
                                            <span class="label u-bold-text">Kurum:</span>
                                            <span>{{ $competition->organizer }}</span>
                                        </li>
                                        <li>
                                            <span class="label u-bold-text">Son Basvuru Tarihi:</span>
                                            <span>{{ date('d.m.Y', strtotime($competition->deadline)) }}</span>
                                        </li>
                                    </ul>
                                    <div class="competitions__details">
                                        <a class="bttn bttn--competition" href="{{ route('competitions.show', $competition->slug) }}">Detaylı İncele</a>
                                    </div>
                                </div>

                                <div class="social__buttons competitions__social">
                                    <a class="fb" rel="nofollow" target="_blank"
                                       href="https://www.facebook.com/share.php?u=http://www.muhendislikyarismalari.com/yarisma/{{$competition->slug}}"
                                       data-link="https://www.facebook.com/share.php?u=http://www.muhendislikyarismalari.com/yarisma/{{$competition->slug}}">
                                        <i class="fab fa-facebook-f"></i><span></span>
                                    </a>
                                    <a id="share" class="tw" href="https://twitter.com/share?original_referer=/&text=&url=
                                        http://www.muhendislikyarismalari.com/yarisma/{{$competition->slug}}" data-link="https://twitter.com/share?original_referer=/&text=&url=
                                        http://www.muhendislikyarismalari.com/yarisma/{{$competition->slug}}" target="_blank">
                                        <i class="fab fa-twitter"></i><span></span>
                                    </a>
                                    <a id="share" class="ln"
                                       href="https://www.linkedin.com/cws/share?url=http://www.muhendislikyarismalari.com/yarisma/{{$competition->slug}}"
                                       data-link="https://www.linkedin.com/cws/share?url=http://www.muhendislikyarismalari.com/yarisma/{{$competition->slug}}"
                                       target="_blank">
                                        <i class="fab fa-linkedin"></i><span></span>
                                    </a>
                                    <a name="whatsapp" id="share" class="wp"
                                       href="https://api.whatsapp.com/send?text=http://www.muhendislikyarismalari.com/yarisma/{{$competition->slug}}" target="_blank">
                                        <i class="fab fa-whatsapp"></i><span></span>
                                    </a>
                                </div>
                            </figure>
                        </div>
                        @endforeach
                    </div>
                    <div class="u-center-text u-margin-top-big">
                        <a class="bttn bttn--green" href="/yarismalar.html">DAHA FAZLA GÖR</a>
                    </div>

                </div>
                @else
                <div class="container">
                
            
                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-body">
                            <h3 class="text-center">Yarışma kategorisi altında henüz paylaşım yapılmadı. Lütfen daha sonra tekrar kontrol ediniz. </h3>
                        </div>
                    </div>
                </div>
            </div>
                @endif
        </section>
        <section class="section-contents">
            <div class="u-center-text u-margin-bottom-big">
                <h2 class="heading-content">
                    İÇERİKLER
                </h2>
            </div>
            @if($contents->count() > 3)
            <div class="container text-center mt-5">
                <div class="row mx-auto my-auto js--wp-2">
                    <div id="myCarousel2" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner w-100" role="listbox">
                            <div class="carousel-item active">
                                <div class="col-lg-4 col-md-6">
                                    <a href="{{ route('contents.link', $first_content[0]->link) }}">
                                        <img class="img-fluid" src="{{ asset('storage/'.$first_content[0]->cover) }}">
                                    </a>
                                </div>
                            </div>
                            @foreach($contents as $content)
                                <div class="carousel-item">
                                    <div class="col-lg-4 col-md-6">
                                        <a href="{{ route('contents.show', [$content->series_link, $content->slug]) }}">
                                            <img class="img-fluid" src="{{ asset('storage/'.$content->cover) }}">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev bg-dark w-auto" href="#myCarousel2" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next bg-dark w-auto" href="#myCarousel2" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            @else
                <div class="row mx-auto">
                    @foreach($contents as $content)
                        <div class="col-lg-4 col-md-6 mx-auto ">
                            <div>
                                <figure class="contents mx-auto">
                                    <a href="{{ route('contents.show', [$content->series_link, $content->slug]) }}">
                                        <img src="{{ asset('storage/'.$content->cover) }}" class="img-fluid" alt="{{ $content->title }}">
                                    </a>
                                </figure>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="u-center-text u-margin-top-huge">
                <a href="#" class="btn-text">İçeriklere Göz At &rarr;</a>
            </div>
        </section>

        <section class="section-announcements">
            <div class="u-center-text u-margin-bottom-big">
                <h2 class="heading-secondary">
                    DUYURULAR
                </h2>
            </div>

            <div class="js--wp-3">
                <div class="row mx-auto u-margin-bottom-big d-flex align-items-center">
                    @foreach($announcements as $announcement)
                        <div class="col-lg-6 d-flex justify-content-around align-items-center">
                            <figure class="competitions u-margin-bottom-big u-margin-top-big">
                                <div class="competitions__hero">
                                    <a href="{{ route('announcements.show', [$announcement->category_slug, $announcement->slug]) }}">
                                        <img src="{{ asset('storage/'.$announcement->image) }}" alt="{{ $announcement->title }}" class="competitions__img">
                                    </a>
                                </div>
                                <div class="competitions__content">
                                    <div class="competitions__title">
                                        <h1 class="competitions__heading u-center-text">{{ $announcement->title }} </h1>
                                        <div class="tags {{$announcement->category_slug}}__tag">{{$announcement->category_slug}}</div>
                                    </div>
                                    @if($announcement->category_slug == 'haber' || $announcement->category_slug == 'derece')
                                        <ul class="competitions__description">
                                            <li>
                                                <span>{{ \Illuminate\Support\Str::limit($announcement->description, 110, $end='...') }}</span>
                                            </li>
                                        </ul>
                                    @else
                                        <ul class="competitions__description">
                                            <li>
                                                <span class="label u-bold-text">Kurum:</span>
                                                <span>{{ $announcement->organizer }}</span>
                                            </li>
                                            <li>
                                                @if($announcement->deadline != null)
                                                        <span class="label u-bold-text">Son Basvuru Tarihi:</span>
                                                        <span>{{ date('d.m.Y', strtotime($announcement->deadline)) }}</span>
                                                    @else
                                                        <span>{!! \Illuminate\Support\Str::limit($announcement->description, 110, $end='...') !!}</span>
                                                    @endif
                                            </li>
                                        </ul>
                                    @endif
                                    <div class="competitions__details">
                                        <a class="bttn bttn--{{$announcement->category_slug}}" href="{{ route('announcements.show', [$announcement->category_slug, $announcement->slug]) }}">Detaylı İncele</a>
                                    </div>
                                </div>

                                <div class="social__buttons announcements__social-{{$announcement->category_slug}}">
                                    <a class="fb" rel="nofollow" target="_blank"
                                       href="https://www.facebook.com/share.php?u=http://www.muhendislikyarismalari.com/yarisma/{{$announcement->slug}}"
                                       data-link="https://www.facebook.com/share.php?u=http://www.muhendislikyarismalari.com/yarisma/{{$announcement->slug}}">
                                        <i class="fab fa-facebook-f"></i><span></span>
                                    </a>
                                    <a id="share" class="tw" href="https://twitter.com/share?original_referer=/&text=&url=
                                        http://www.muhendislikyarismalari.com/yarisma/{{$announcement->slug}}" data-link="https://twitter.com/share?original_referer=/&text=&url=
                                        http://www.muhendislikyarismalari.com/yarisma/{{$announcement->slug}}" target="_blank">
                                        <i class="fab fa-twitter"></i><span></span>
                                    </a>
                                    <a id="share" class="ln"
                                       href="https://www.linkedin.com/cws/share?url=http://www.muhendislikyarismalari.com/yarisma/{{$announcement->slug}}"
                                       data-link="https://www.linkedin.com/cws/share?url=http://www.muhendislikyarismalari.com/yarisma/{{$announcement->slug}}"
                                       target="_blank">
                                        <i class="fab fa-linkedin"></i><span></span>
                                    </a>
                                    <a name="whatsapp" id="share" class="wp"
                                       href="https://api.whatsapp.com/send?text=http://www.muhendislikyarismalari.com/yarisma/{{$announcement->slug}}" target="_blank">
                                        <i class="fab fa-whatsapp"></i><span></span>
                                    </a>
                                </div>
                            </figure>
                        </div> 
                    @endforeach
                </div>

                <div class="u-center-text u-margin-top-big">
                    <a class="bttn bttn--green" href="{{ route('announcements.index') }}">DAHA FAZLA GÖR</a>
                </div>
        </section>
    </main>

    @include('includes.footer')
@endsection
