@extends('layouts.app')

@section('meta')
    <meta property="fb:app_id"        content="{{$announcement->fbappid}}"/>
    <meta property="og:url"           content="{{ $url }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{$announcement->page_title}}" />
    <meta property="og:image"         content="{{ asset('/'.$announcement->image) }}" />
@endsection

@section('title')
    <title>{{ $announcement->title }}</title>
@endsection


@section('contents')

    @include('includes.navigation')

    <div class="container u-margin-top-big"> <!--Container-->
        <div class="blog-header"> <!-- Blog Header-->
            <div class="brow" > <!-- Row -->
                <div class="col-sm-10 mx-auto"> <!-- Main Blog Area -->

                    <h1 class="text-center mt-5 mb-3"><strong>{{ $announcement->title }}</strong></h1>
                    <section id="social2">
                        <div class="social_panel">
                            <i class="fas fa-share-alt"></i>
                            <div class="shared-count">
                                <span class="number">0</span>
                                <span class="shares">Paylaşım</span>
                            </div>
                            <a class="fb" rel="nofollow" target="_blank"
                               href="https://www.facebook.com/share.php?u=http://www.muhendislikyarismalari.com/duyuru/{{$announcement->category_slug}}/{{$announcement->slug}}"
                               data-link="https://www.facebook.com/share.php?u=http://www.muhendislikyarismalari.com/duyuru/{{$announcement->category_slug}}/{{$announcement->slug}}">
                                <i class="fab fa-facebook-f"></i>
                                <span class="social_share">Paylas</span>
                            </a>

                            <a name="whatsapp" style="background-color: #4dc247;" id="share" class="wp"
                               href="https://api.whatsapp.com/send?text=http://www.muhendislikyarismalari.com/duyuru/{{$announcement->category_slug}}/{{$announcement->slug}}" target="_blank">
                                <i class="fab fa-whatsapp"></i>
                                <span class="social_share">Paylas</span>

                            </a>
                            <a style="background-color: #007bb5;" id="share" class="ln"
                               href="https://www.linkedin.com/cws/share?url=http://www.muhendislikyarismalari.com/duyuru/{{$announcement->category_slug}}/{{$announcement->slug}}"
                               data-link="https://www.linkedin.com/cws/share?url=http://www.muhendislikyarismalari.com/duyuru/{{$announcement->category_slug}}/{{$announcement->slug}}"
                               target="_blank">
                                <i class="fab fa-linkedin"></i>
                                <span class="social_share">Paylas</span>
                            </a>
                            <a style="background-color: #55acee;" id="share" class="tw"
                               href="https://twitter.com/share?original_referer=/&text=&url=
                                            http://www.muhendislikyarismalari.com/duyuru/{{$announcement->category_slug}}/{{$announcement->slug}}" data-link="https://twitter.com/share?original_referer=/&text=&url=
                                            http://www.muhendislikyarismalari.com/duyuru/{{$announcement->category_slug}}/{{$announcement->slug}}" target="_blank">
                                <i class="fab fa-twitter"></i>
                                <span class="social_share">Paylas</span>

                            </a>
                            <div class="page-view">
                                <span class="read_number">{{ $pageViews }}</span>
                                <span class="read">Okunma</span>
                            </div>
                        </div>
                    </section>
                    <div class="card mb-5 containerdiv">

                        <img class="card-img-top" style="height: auto; max-height: 50rem;" src="{{ asset('/'.$announcement->image) }}" alt=""/>


                        <div class="card-body">
                            <div class="comp-page--details">
                                <p><strong>Kategori:</strong> <span style="text-transform: uppercase;">{{$announcement->category_slug}}</span></p>
                                <p>
                                    <span>{{ date('d.m.Y', strtotime($announcement->created_at)) }}  tarihinde yayımlandı.</span>
                                </p>
                                <p>
                                    @if($announcement->deadline != null)
                                         @if($difference > 0 && $difference < 4)
                                            <span class="align-items-start text-danger">Başvuruların {{ $difference }} tamamlanmasına  gün kaldı.</span>
                                        @elseif($difference > 3 && $difference < 11)
                                            <span class="text-warning">Başvuruların tamamlanmasına {{ $difference }} gün kaldı.</span>
                                        @elseif($difference === 0)
                                            <span class="text-danger">Başvurular bugün kapanıyor.</span>
                                        @elseif($difference === -1)
                                            <span><del>Başvurular sona erdi.</del></span>
                                        @else
                                            <span class="align-items-start text-success	">Başvuruların tamamlanmasına {{ $difference }} gün kaldı.</span>
                                        @endif
                                    @endif
                                   
                                </p>
                            </div>
                            
                            <hr class="cerite-{{$announcement->category_slug}} u-margin-bottom-small"/>
                            <div class="announcements-details">
                                <p>{!! $announcement->description !!}</p>
                                @if($announcement->reward != null)
                                    <p>
                                        <strong>ÖDÜL : </strong>
                                        <br/>
                                        {!! $announcement->reward !!}
                                    </p>
                                @endif
                                <p><strong>YARIŞMAYI DÜZENLEYEN:</strong> {!! $announcement->organizer !!}</p>
                                @if($announcement->deadline != null)
                                    <p><strong>SON BAŞVURU TARİHİ:</strong> {!! date('d.m.Y', strtotime($announcement->deadline)) !!} </p>
                                @endif
                                <div class="u-center-text u-margin-top-medium u-margin-bottom-medium">
                                    <a class="bttn bttn--green" href="{{ $announcement->detail }}" target="_blank">DETAYLI BİLGİ İÇİN TIKLAYIN</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
