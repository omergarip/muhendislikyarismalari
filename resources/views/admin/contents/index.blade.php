@extends('layouts.dashboard')

@section('title')
    <title>İçerik</title>
@endsection

@section('contents')
    <div class="container-fluid mt-5">
        <div class="form-group">
            <a href="{{ route('contents.create') }}"
               class="btn btn-lg btn-primary my-5">
                Yeni İçerik Ekle
            </a>
            <a href="{{ route('publisher.create') }}"
               class="btn btn-lg btn-primary my-5">
                Yeni Yazar Ekle
            </a>
        </div>
        <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Yayınlanan İçerikler</a>
                <a class="nav-item nav-link" id="nav-not-published-tab" data-toggle="tab" href="#nav-not-published" role="tab" aria-controls="nav-not-published" aria-selected="true">Yayınlanmayan İçerikler</a>
                <a class="nav-item nav-link" id="nav-removed-tab" data-toggle="tab" href="#nav-removed" role="tab" aria-controls="nav-removed" aria-selected="false">Silinen İçerikler</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Fotoğraf</th>
                            <th>Link</th>
                            <th>Başlık</th>
                            <th>İçerik Serisi</th>
                            <th>Önizle</th>
                            <th>Aksiyon</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contents as $content)
                            <tr>
                                <th scope="row">{{ $content->id }}</th>
                                <td>
                                    @if($content->cover == '')
                                        <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                    @else
                                        <img src="{{ asset('/'.$content->cover) }}">
                                    @endif
                                </td>
                                <td>{{ $content->page_title }}</td>
                                <td>{{ $content->title }} </td>
                                <td>{{ $content->series_link }}</td>
                                <td><a class="btn btn-primary"
                                       href="{{ route('contents.show', [$content->series_link, $content->slug]) }}"
                                       target="_blank">Önizle</a></td>
                                <td>
                                    @if(auth()->user()->user_type != '$content-manager' || auth()->user()->user_type != 'admin')
                                        <div class="dropdown">
                                            <button class="btn-success btn dropdown-toggle form-control" data-toggle="dropdown">Güncelle</button>
                                            <div class="dropdown-menu">
                                                <a href="{{ route('contents.edit', $content->slug) }}" class="dropdown-item">Detaylar</a>
                                                <a href="{{ route('media.edit', $content->id) }}" class="dropdown-item">İçerik</a>
                                            </div>
                                        </div>
                                        <form action="{{ route('contents.reverse', $content->id)}}" method="POST">
                                            @csrf
                                            @method('put')
                                            <button class="form-control btn btn-sm btn-danger">Geri Çek</button>
                                        </form>

                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-not-published" role="tabpanel" aria-labelledby="nav-not-published-tab">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Fotoğraf</th>
                            <th>Link</th>
                            <th>Başlık</th>
                            <th>İçerik Serisi</th>
                            <th>Önizle</th>
                            <th>Güncelle</th>
                            <th>Aksiyon</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($not_published as $content)
                            <tr>
                                <th scope="row">{{ $content->id }}</th>
                                <td>
                                    @if($content->cover == '')
                                        <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                    @else
                                        <img src="{{ asset('/'.$content->cover) }}">
                                    @endif
                                </td>
                                <td>{{ $content->page_title }}</td>
                                <td>{{ $content->title }} </td>
                                <td>{{ $content->series_link }}</td>
                                <td><a class="btn btn-primary"
                                       href="{{ route('contents.show', [$content->series_link, $content->slug]) }}"
                                       target="_blank">Önizle</a></td>
                                <td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn-success btn dropdown-toggle form-control" data-toggle="dropdown">Güncelle</button>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('contents.edit', $content->slug) }}" class="dropdown-item">Detaylar</a>
                                            <a href="{{ route('media.edit', $content->id) }}" class="dropdown-item">İçerik</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if(auth()->user()->user_type != '$content-manager' || auth()->user()->user_type != 'admin')
                                        <div class="form-group">

                                            <form action="{{ route('contents.publish', $content->id)}}" method="POST">
                                                @csrf
                                                @method('put')
                                                <button class="form-control btn btn-sm btn-primary">Yayınla</button>
                                            </form>
                                            <form action="{{ route('contents.delete', $content->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE ')
                                                <button class="form-control btn btn-sm btn-danger">Sil</button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-removed" role="tabpanel" aria-labelledby="nav-removed-tab">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Fotoğraf</th>
                            <th>Link</th>
                            <th>Başlık</th>
                            <th>İçerik Serisi</th>
                            <th>Aksiyon</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($removed_contents as $content)
                            <tr>
                                <th scope="row">{{ $content->id }}</th>
                                <td>
                                    @if($content->cover == '')
                                        <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                    @else
                                        <img src="{{ asset('/'.$content->cover) }}">
                                    @endif
                                </td>
                                <td>{{ $content->page_title }}</td>
                                <td>{{ $content->title }} </td>
                                <td>{{ $content->series_link }}</td>
                                <td>
                                    @if(auth()->user()->user_type != '$content-manager' || auth()->user()->user_type != 'admin')
                                        <div class="form-group">
                                            <form action="{{ route('contents.delete', $content->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE ')
                                                <button class="form-control btn btn-sm btn-danger">Sil</button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
