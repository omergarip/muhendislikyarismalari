@extends('layouts.app')

@section('meta')
    <meta property="fb:app_id"        content="{{ config('view.FB_APP_ID') }}"/>
    <meta property="og:url"           content="{{ $url }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{$content->page_title}}" />
    <meta property="og:image"  itemprop="image"       content="{{ asset('/'.$content->cover) }}" />
@endsection

@section('title')
    <title>{{ $content->title }}</title>
@endsection

@section('contents')

    @include('includes.navigation')

    <div class="container u-margin-bottom-big u-margin-top-big"> <!--Container-->
        <div class="content-page"> <!-- Blog Header-->
            <div class="brow" > <!-- Row -->
                <div class="col-sm-10 mx-auto"> <!-- Main Blog Area -->
                    <div class="content-header u-margin-top-big">
                        <div class="content-header__top ">
                            <h1>{{ $content->page_title }}</h1>
                            <div class="content-header__info">
                                <div class="content-header__links">
                                    <a href="{{ route('home') }}">Ana sayfa
                                        <span>&nbsp;>&nbsp; {{ env('APP_NAME') }}</span>
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
                            <img class="my-2  img-fluid" src="{{ asset('/'.$content->cover) }}" alt="{{ $content->title }}"/>
                        </div>
                        <div class="owner__profile">
                            <img src="{{ asset('/img/profile.jpeg') }}">
                            <h6><strong>Mühendislik Yarışmaları <br><span></span></strong></h6>
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
                    <div class="content-page__img mx-auto">
                        <img class="my-2 img-fluid" src="{{ asset('/'.$content->image) }}" alt="{{ $content->title }}"/>
                    </div>
                    @if($content->text1 != '')
                        <div class="content-page__detail">
                            {!! $content->text1 !!}
                        </div>
                    @endif
                    @if($content->image1 != '')
                        <div class="content-page__img mx-auto">
                            <img class="img-fluid my-2" src="{{ asset('/'.$content->image1) }}" alt="{{ $content->title }}"/>
                        </div>
                    @endif
                    @if($content->text2 != '')
                        <div class="content-page__detail">
                            {!! $content->text2 !!}
                        </div>
                    @endif
                    @if($content->image2 != '')
                        <div class="content-page__img mx-auto">
                            <img class="img-fluid my-2" src="{{ asset('/'.$content->image2) }}" alt="{{ $content->title }}"/>
                        </div>
                    @endif
                    @if($content->text3 != '')
                        <div class="content-page__detail">
                            {!! $content->text3 !!}
                        </div>
                    @endif
                    @if($content->image3 != '')
                        <div class="content-page__img mx-auto">
                            <img class="img-fluid my-2" src="{{ asset('/'.$content->image3) }}" alt="{{ $content->title }}"/>
                        </div>
                    @endif
                    @if($content->text4 != '')
                        <div class="content-page__detail">
                            {!! $content->text4 !!}
                        </div>
                    @endif
                    @if($content->image4 != '')
                        <div class="content-page__img mx-auto">
                            <img class="img-fluid my-2" src="{{ asset('/'.$content->image4) }}" alt="{{ $content->title }}"/>
                        </div>
                    @endif
                    @if($content->text5 != '')
                        <div class="content-page__detail">
                            {!! $content->text5 !!}
                        </div>
                    @endif
                    @if($content->image5 != '')
                        <div class="content-page__img mx-auto">
                            <img class="img-fluid my-2" src="{{ asset('/'.$content->image5) }}" alt="{{ $content->title }}"/>
                        </div>
                    @endif
                    @if($content->text6 != '')
                        <div class="content-page__detail">
                            {!! $content->text6 !!}
                        </div>
                    @endif
                    @if($content->image6 != '')
                        <div class="content-page__img mx-auto">
                            <img class="img-fluid my-2" src="{{ asset('/'.$content->image6) }}" alt="{{ $content->title }}"/>
                        </div>
                    @endif
                    @if($content->text7 != '')
                        <div class="content-page__detail">
                            {!! $content->text7 !!}
                        </div>
                    @endif
                    @if($content->image7 != '')
                        <div class="content-page__img mx-auto">
                            <img class="img-fluid my-2" src="{{ asset('/'.$content->image7) }}" alt="{{ $content->title }}"/>
                        </div>
                    @endif
                    @if($content->text8 != '')
                        <div class="content-page__detail">
                            {!! $content->text8 !!}
                        </div>
                    @endif
                    @if($content->image8 != '')
                        <div class="content-page__img mx-auto">
                            <img class="img-fluid my-2" src="{{ asset('/'.$content->image8) }}" alt="{{ $content->title }}"/>
                        </div>
                    @endif
                    @if($content->text9 != '')
                        <div class="content-page__detail">
                            {!! $content->text9 !!}
                        </div>
                    @endif
                    @if($content->image9 != '')
                        <div class="content-page__img mx-auto">
                            <img class="img-fluid my-2" src="{{ asset('/'.$content->image9) }}" alt="{{ $content->title }}"/>
                        </div>
                    @endif
                    @if($content->text10 != '')
                        <div class="content-page__detail">
                            {!! $content->text10 !!}
                        </div>
                    @endif
                    @if($content->image10 != '')
                        <div class="content-page__img mx-auto">
                            <img class="img-fluid my-2" src="{{ asset('/'.$content->image10) }}" alt="{{ $content->title }}"/>
                        </div>
                    @endif
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

[5] Overture by Wilhem Conrad Röntgen<br/><a style="font-size: 1.3rem; word-break: break-all;" href="http://www.xtal.iqfr.csic.es/Cristalografia/parte_10-en.html">http://www.xtal.iqfr.csic.es/Cristalografia/parte_10-en.html</a><br/>[6] Eckert, M., (2012), Max von Laue and the discovery of X-ray diffraction in 1912, Ann. Phys. (Berlin) 524, No. 5, A83–A85.
