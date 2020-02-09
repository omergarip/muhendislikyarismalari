@extends('layouts.app')

@section('title')
    <title>Duyurular</title>
@endsection

@section('contents')
    @include('includes.navigation')
    <div class="navigation">
        <input type="checkbox" class="navigation__checkbox" id="navi-toggle">

        <label for="navi-toggle" class="navigation__button">
            <span class="navigation__icon">&nbsp;</span>
        </label>

        <div class="navigation__background">&nbsp;</div>

        <nav class="navigation__nav">
            <ul class="navigation__list">
                @foreach($categories as $category)
                    <li class="content-navigation__item">

                        <a class="navigation__link {{ $uri == 'duyurular/'.$category->slug ? 'active' : ''}}"
                           href="{{ route('announcements.link', $category->slug) }}" >
                            {{ $category->category_name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
    <section  class="section-announcements" id="announcements-page">
        <div id="wrapper">
            <div id="sidebar-wrapper">
                <aside id="sidebar">
                    <ul id="sidemenu" class="sidebar-nav">
                        @foreach($categories as $category)
                            <li>
                                <a class="{{ $uri == 'duyurular/'.$category->slug ? 'active' : ''}}"
                                   href="{{ route('announcements.link', $category->slug) }}" >
                                    <span class="sidebar-title ">{{ $category->category_name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </aside>
            </div>
            <main id="page-content-wrapper" role="main">
                <div class="row mx-auto">
                    @if($announcements->count() > 0)
                        <div class="col-lg-12 mx-auto">
                            <div>
                                <div class="u-center-text u-margin-bottom-medium ">
                                    <h2 class="heading-secondary u-margin-top-huge">
                                        DUYURULAR
                                    </h2>
                                </div>
                                @foreach($announcements as $announcement)
                                    <figure class="competitions mx-auto">
                                        <div class="competitions__hero">
                                            <a href="{{ route('announcements.show', [$announcement->category_slug, $announcement->slug]) }}">
                                                <img src="{{ asset('storage/'.$announcement->image) }}" alt="{{ $announcement->title }}" class="competitions__img">
                                            </a>
                                        </div>
                                        <div class="competitions__content">
                                            <div class="competitions__title">
                                                <h1 class="competitions__heading u-center-text">{{ $announcement->title }}</h1>
                                                <div class="tags {{$announcement->category_slug }}__tag">{{ $announcement->category_slug }}</div>
                                            </div>
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
                                            <div class="competitions__details">
                                                <a class="bttn bttn--{{$announcement->category_slug }}" href="{{ route('announcements.show', [$announcement->category_slug,$announcement->slug]) }}">Detaylı İncele</a>
                                            </div>
                                        </div>
                                        <div class="social__buttons announcements__social-{{$announcement->category_slug }}">
                                            <a class="fb" rel="nofollow" target="_blank"
                                               href="https://www.facebook.com/share.php?u=http://www.muhendislikyarismalari.com/duyuru/{{$announcement->category_slug}}/{{$announcement->slug}}"
                                               data-link="https://www.facebook.com/share.php?u=http://www.muhendislikyarismalari.com/duyuru/{{$announcement->category_slug}}/{{$announcement->slug}}">
                                                <i class="fab fa-facebook-f"></i><span></span>
                                            </a>
                                            <a id="share" class="tw" href="https://twitter.com/share?original_referer=/&text=&url=
                                            http://www.muhendislikyarismalari.com/duyuru/{{$announcement->category_slug}}/{{$announcement->slug}}" data-link="https://twitter.com/share?original_referer=/&text=&url=
                                            http://www.muhendislikyarismalari.com/duyuru/{{$announcement->category_slug}}/{{$announcement->slug}}" target="_blank">
                                                <i class="fab fa-twitter"></i><span></span>
                                            </a>
                                            <a id="share" class="ln"
                                               href="https://www.linkedin.com/cws/share?url=http://www.muhendislikyarismalari.com/duyuru/{{$announcement->category_slug}}/{{$announcement->slug}}"
                                               data-link="https://www.linkedin.com/cws/share?url=http://www.muhendislikyarismalari.com/duyuru/{{$announcement->category_slug}}/{{$announcement->slug}}"
                                               target="_blank">
                                                <i class="fab fa-linkedin"></i><span></span>
                                            </a>
                                            <a name="whatsapp" id="share" class="wp"
                                               href="https://api.whatsapp.com/send?text=http://www.muhendislikyarismalari.com/duyuru/{{$announcement->category_slug}}/{{$announcement->slug}}" target="_blank">
                                                <i class="fab fa-whatsapp"></i><span></span>
                                            </a>
                                        </div>
                                    </figure>
                                @endforeach
                            </div> <!-- End of the list  -->
                        </div> <!-- End of the col-lg-9  -->
                    @else
                        <div class="card card-default mx-auto mb-auto">
                            <div class="card-body">
                                <h3>Bu kategori altında duyuru paylaşımı henüz yapılmadı.Lütfen daha sonra tekrar kontrol ediniz.</h3>
                            </div>
                        </div>
                    @endif

                </div> <!-- End of the row  -->
                {{ $announcements->links() }}
            </main>
        </div>


    </section>

    @include('includes.footer')

@endsection
