@extends('layouts.app')

@section('meta')
    <meta property="fb:app_id"        content="{{ $content->fbappid }}"/>
    <meta property="og:url"           content="{{ $url }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{$content->page_title}}" />
    <meta property="og:description"   content="{{$content->description}}" />
    <meta property="og:image"          itemprop="image"       content="{{ asset('/'.$content->cover) }}" />
@endsection

@section('title')
    <title>{{ $content->page_title }}</title>
@endsection

@section('contents')

    @include('includes.navigation')

    <div class="container u-margin-bottom-big u-margin-top-small"> <!--Container-->
        <div class="content-page"> <!-- Blog Header-->
            <div class="brow" > <!-- Row -->
                <div class="col-sm-11 mx-auto"> <!-- Main Blog Area -->
                    <div class="content-header u-margin-top-big">
                        <div class="content-header__top ">
                            <h1>{{ $content->page_title }}</h1>
                            <div class="content-header__info">
                                <div class="content-header__links">
                                    <a href="{{ route('home') }}">Ana sayfa  <span>&nbsp;>&nbsp;</span>
                                    </a>
                                    <a href="{{ route('contents.index') }}">İçerikler
                                        <span>&nbsp;>&nbsp;</span>
                                    </a>
                                    <a href="{{ route('contents.index', $series->link) }}">{{ $series->series_name }}</a>
                                </div>
                                <p>{{ date('d.m.Y H:i:s', strtotime($content->created_at)) }}' te yayınlandı.</p>
                                @if($content->created_at != $content->updated_at)
                                    <p>{{ date('d.m.Y H:i:s', strtotime($content->updated_at)) }}' te düzenlendi.</p>
                                @endif
                            </div>

                        </div>
                        <div class="content-page__img mx-auto">
                            <img class="my-2  img-fluid" src="{{ asset('storage/'.$content->cover) }}" alt="{{ $content->title }}"/>
                        </div>
                        <div class="owner__profile">
                            @if($content->publisher_id == 0)
                                <img src="{{ asset('/img/profile.jpeg') }}">
                                <h6><strong>Mühendislik Yarışmaları <br><span></span></strong></h6>
                            @else
                                <img src="{{ asset('storage/' . $content->publisher->photo) }}">
                                <div style="margin-top: 4rem;">
                                    <h6 style="font-size: 1.3rem; margin-top: 0;"><strong>{{ $content->publisher->fullname }}<span></span></strong></h6>
                                    <h6 style="font-size: 1.3rem; margin-top: 0;"><strong>{{ $content->publisher->school }}<span></span></strong></h6>
                                    <h6 style="font-size: 1.3rem; margin-top: 0;"><strong>{{ $content->publisher->title }}<span></span></strong></h6>
                                </div>
                            @endif
                        </div>
                    </div>
                    <section id="social2">
                        <div class="social_panel">
                            <i class="fas fa-share-alt"></i>
                            <div class="shared-count">
                                <span class="number">0</span>
                                <span class="shares">Paylaşım</span>
                            </div>
                            <a class="fb" rel="nofollow" target="_blank"
                               href="https://www.facebook.com/share.php?u=http://www.muhendislikyarismalari.com/icerik/{{$content->series_link}}/{{$content->slug}}"
                               data-link="https://www.facebook.com/share.php?u=http://www.muhendislikyarismalari.com/icerik/{{$content->series_link}}/{{$content->slug}}">
                                <i class="fab fa-facebook-f"></i>
                                <span class="social_share">Paylas</span>
                            </a>

                            <a name="whatsapp" style="background-color: #4dc247;" id="share" class="wp"
                               href="https://api.whatsapp.com/send?text=http://www.muhendislikyarismalari.com/icerik/{{$content->series_link}}/{{$content->slug}}" target="_blank">
                                <i class="fab fa-whatsapp"></i>
                                <span class="social_share">Paylas</span>

                            </a>
                            <a style="background-color: #007bb5;" id="share" class="ln"
                               href="https://www.linkedin.com/cws/share?url=http://www.muhendislikyarismalari.com/icerik/{{$content->series_link}}/{{$content->slug}}"
                               data-link="https://www.linkedin.com/cws/share?url=http://www.muhendislikyarismalari.com/icerik/{{$content->series_link}}/{{$content->slug}}"
                               target="_blank">
                                <i class="fab fa-linkedin"></i>
                                <span class="social_share">Paylas</span>
                            </a>
                            <a style="background-color: #55acee;" id="share" class="tw"
                               href="https://twitter.com/share?original_referer=/&text=&url=
                                            http://www.muhendislikyarismalari.com/icerik/{{$content->series_link}}/{{$content->slug}}" data-link="https://twitter.com/share?original_referer=/&text=&url=
                                            http://www.muhendislikyarismalari.com/icerik/{{$content->series_link}}/{{$content->slug}}" target="_blank">
                                <i class="fab fa-twitter"></i>
                                <span class="social_share">Paylas</span>

                            </a>
                            <div class="page-view">
                                <span class="read_number">{{ $pageViews }}</span>
                                <span class="read">Okunma</span>
                            </div>
                        </div>
                    </section>

                    <div class="content-page__detail">
                        {!! $content->text !!}
                    </div>
                    <h1 class="text-center mt-5">
                        <strong>Bilgi paylaştıkça çoğalır. Çevrenizdeki mühendisler ile içeriği paylaşarak bize destek olabilirsiniz.</strong>
                    </h1>


                    <section id="social2">
                        <div class="social_panel" style="height: 3rem;">
                            <a class="fb" rel="nofollow" target="_blank"
                               href="https://www.facebook.com/share.php?u=http://www.muhendislikyarismalari.com/icerik/{{$content->series_link}}/{{$content->slug}}"
                               data-link="https://www.facebook.com/share.php?u=http://www.muhendislikyarismalari.com/icerik/{{$content->series_link}}/{{$content->slug}}">
                                <i class="fab fa-facebook-f"></i>
                                <span class="social_share">Paylas</span>
                            </a>

                            <a name="whatsapp" style="background-color: #4dc247;" id="share" class="wp"
                               href="https://api.whatsapp.com/send?text=http://www.muhendislikyarismalari.com/icerik/{{$content->series_link}}/{{$content->slug}}" target="_blank">
                                <i class="fab fa-whatsapp"></i>
                                <span class="social_share">Paylas</span>

                            </a>
                            <a style="background-color: #007bb5;" id="share" class="ln"
                               href="https://www.linkedin.com/cws/share?url=http://www.muhendislikyarismalari.com/icerik/{{$content->series_link}}/{{$content->slug}}"
                               data-link="https://www.linkedin.com/cws/share?url=http://www.muhendislikyarismalari.com/icerik/{{$content->series_link}}/{{$content->slug}}"
                               target="_blank">
                                <i class="fab fa-linkedin"></i>
                                <span class="social_share">Paylas</span>
                            </a>
                            <a style="background-color: #55acee;" id="share" class="tw"
                               href="https://twitter.com/share?original_referer=/&text=&url=
                                            http://www.muhendislikyarismalari.com/icerik/{{$content->series_link}}/{{$content->slug}}" data-link="https://twitter.com/share?original_referer=/&text=&url=
                                            http://www.muhendislikyarismalari.com/icerik/{{$content->series_link}}/{{$content->slug}}" target="_blank">
                                <i class="fab fa-twitter"></i>
                                <span class="social_share">Paylas</span>

                            </a>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
@endsection
