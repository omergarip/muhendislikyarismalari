@extends('layouts.app')

@section('title')
    <title>İçerikler</title>
@endsection

@section('contents')
    @include('includes.navigation')
    <div class="content" style="background-color: #f5f5f5;">
        <div class="content-navigation">
            <input type="checkbox" class="navigation__checkbox" id="navi-toggle">

            <label for="navi-toggle" class="navigation__button">
                <span class="navigation__icon">&nbsp;</span>
            </label>

            <div class="navigation__background">&nbsp;</div>

            <nav class="navigation__nav">
                <ul class="content-navigation__list">
                    @foreach($series as $cseries)
                        <li class="content-navigation__item">
                            <a class="navigation__link {{ $uri == 'icerikler/'.$cseries->link ? 'active' : ''}}"
                               href="{{ route('contents.link', $cseries->link) }}" >
                                {{ $cseries->series_name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
        <main>
            <section class="section-content" id="content-page">

                <div id="wrapper">
                    <div id="content-sidebar-wrapper">
                        <aside id="sidebar">
                            <ul id="sidemenu" class="sidebar-nav">
                                @foreach($series as $cseries)
                                    <li>
                                        <a class="{{ $uri == 'icerikler/'.$cseries->link ? 'active' : ''}}"
                                           href="{{ route('contents.link', $cseries->link) }}" >
                                            <span class="sidebar-title ">{{ $cseries->series_name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>
                    </div>
                    <main id="page-content-wrapper" role="main">
                        <div class="row mx-auto">
                            <div class="u-center-text u-margin-bottom-medium u-margin-top-huge w-100">
                                <h2 class="heading-secondary">
                                    İÇERİKLER
                                </h2>
                            </div>
                            @if($contents->count() > 0)
                                @foreach($contents as $content)
                                    <div class="col-lg-6 mx-auto ">
                                        <div>
                                            <figure class="contents mx-auto">
                                                <a href="{{ route('contents.show', [$content->series_link, $content->slug]) }}">
                                                    <img src="{{ asset('/'.$content->cover) }}" class="img-fluid" alt="{{ $content->title }}">
                                                </a>
                                            </figure>
                                        </div> <!-- End of the list  -->
                                    </div> <!-- End of the col-lg-6  -->
                                @endforeach
                            @else
                                <div class="card card-default mx-auto mb-auto">
                                    <div class="card-body">
                                        <h3>Bu içerik serisi altında henüz paylaşım yapılmadı. Lütfen daha sonra tekrar kontrol ediniz</h3>
                                    </div>
                                </div>
                            @endif
                        </div> <!-- End of the row  -->
                    </main>
                </div>



            </section>
        </main>
        <div class="text-center">
            {{ $contents->links() }}
        </div>
    </div>


    @include('includes.footer')

@endsection
