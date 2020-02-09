@extends('layouts.app')

@section('title')
    <title>Yarışmalar</title>
@endsection

@section('contents')
    @include('includes.navigation')
    <div class="content" style="background-color: #f5f5f5;">
        <section class="section-competitions" id="competitions-page">
            <div class="row mx-auto">
                @if($competitions->count() > 0)
                    <div class="col-xl-10 mx-auto">
                        <div>
                            <div class="u-center-text u-margin-bottom-medium ">
                                <h2 class="heading-secondary u-margin-top-huge">
                                    YARIŞMALAR
                                </h2>
                            </div>
                            @foreach($competitions as $competition)
                            <figure class="competitions mx-auto">
                                <div class="competitions__hero">
                                    <img src="{{ asset('storage/'.$competition->image) }}" alt="{{ $competition->title }}" class="competitions__img">
                                </div>
                                <div class="competitions__content">
                                    <div class="competitions__title">
                                        <h1 class="competitions__heading u-center-text">{{ $competition->title }}</h1>
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
                            @endforeach
                        </div> <!-- End of the list  -->
                    </div> <!-- End of the col-lg-9  -->
                @else


            </div> <!-- End of the row  -->
            {{ $competitions->links() }}


        </section>
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
</div>
    @include('includes.footer')

@endsection
