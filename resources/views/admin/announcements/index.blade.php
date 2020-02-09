@extends('layouts.dashboard')

@section('title')
    <title>Duyuru</title>
@endsection

@section('contents')
    <div class="container-fluid mt-5">
        <a href="{{ route('announcements.create') }}"
           class="btn btn-lg btn-primary my-5">
            Yeni Duyuru Ekle
        </a>
        <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Duyurular</a>
                <a class="nav-item nav-link" id="nav-removed-tab" data-toggle="tab" href="#nav-removed" role="tab" aria-controls="nav-removed" aria-selected="false">Silinen Duyurular</a>
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
                            <th>Kurum</th>
                            <th>Başlık</th>
                            <th>Son Başvuru Tarihi</th>
                            <th>Aksiyon</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($announcements as $announcement)
                            <tr>
                                <th scope="row">{{ $announcement->id }}</th>
                                <td>
                                    @if($announcement->image == '')
                                        <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                    @else
                                        <img src="{{ asset('storage/'.$announcement->image) }}">
                                    @endif
                                </td>
                                <td>{{ $announcement->organizer }}</td>
                                <td>{{ $announcement->title }} </td>
                                <td>{{ $announcement->deadline }}</td>
                                <td>
                                    @if(auth()->user()->user_type != 'competition-manager' || auth()->user()->user_type != 'admin')
                                        <div class="form-group">
                                            <a href="{{ route('announcements.edit', $announcement->slug) }}" class="form-control btn btn-sm btn-primary">Güncelle</a>
                                            <form action="{{ route('announcements.delete', $announcement->id)}}" method="POST">
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
            <div class="tab-pane fade" id="nav-removed" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Fotoğraf</th>
                            <th>Kurum</th>
                            <th>Başlık</th>
                            <th>Son Başvuru Tarihi</th>
                            <th>Aksiyon</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($removed_announcements as $announcement)
                            <tr>
                                <th scope="row">{{ $announcement->id }}</th>
                                <td>
                                    @if($announcement->image == '')
                                        <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                    @else
                                        <img src="{{ asset('storage/'.$announcement->image) }}">
                                    @endif
                                </td>
                                <td>{{ $announcement->organizer }}</td>
                                <td>{{ $announcement->title }} </td>
                                <td>{{ $announcement->deadline }}</td>
                                <td>
                                    @if(auth()->user()->user_type != 'competition-manager' || auth()->user()->user_type != 'admin')
                                        <div class="form-group">
                                            <form action="{{ route('announcements.delete', $announcement->id)}}" method="POST">
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
