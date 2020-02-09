@extends('layouts.dashboard')

@section('title')
    <title>Ekip Üyeleri</title>
@endsection

@section('contents')
    <div class="container-fluid mt-5">
        <a href="{{ route('users.create') }}"
           class="btn btn-lg btn-primary my-5">
            Yeni Ekip Üyesi Ekle
        </a>
        <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Ekip Üyeleri</a>
                <a class="nav-item nav-link" id="nav-not-completed-tab" data-toggle="tab" href="#nav-not-completed" role="tab" aria-controls="nav-not-completed" aria-selected="false">Üyeliği Tamamlamayanlar</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Ekipten Çıkarılanlar</a>
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
                                <th>İsim</th>
                                <th>E-mail</th>
                                <th>Görevi</th>
                                <th>Doğum Tarihi</th>
                                <th>Aksiyon</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>
                                    @if($user->photo == '')
                                        <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                    @else
                                        <img src="{{ asset('storage/'.$user->photo) }}">
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }} </td>
                                <td>
                                    @if($user->user_type == 'admin')
                                        Yönetici
                                    @elseif($user->user_type == 'competition-manager')
                                        Yarışma/Duyuru Sorumlusu
                                    @else
                                        İçerik Sorumlusu
                                    @endif
                                </td>
                                <td>{{ $user->birthday }}</td>
                                <td>
                                    @if($user->user_type != 'admin')
                                        <div class="form-group">
                                            <form action="{{ route('users.removeUser', $user->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE ')
                                                <button class="form-control btn btn-sm btn-danger">Çıkar</button>
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
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Fotoğraf</th>
                            <th>İsim</th>
                            <th>E-mail</th>
                            <th>Görevi</th>
                            <th>Doğum Tarihi</th>
                            <th>Aksiyon</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($removed_users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>
                                    @if($user->photo == '')
                                        <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                    @else
                                        <img src="{{ asset('storage/'.$user->photo) }}">
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }} </td>
                                <td>
                                    @if($user->user_type == 'admin')
                                        Yönetici
                                    @elseif($user->user_type == 'competition-manager')
                                        Yarışma/Duyuru Sorumlusu
                                    @else
                                        İçerik Sorumlusu
                                    @endif
                                </td>
                                <td>{{ $user->birthday }}</td>
                                <td>
                                    @if($user->user_type != 'admin')
                                        <div class="form-group">
                                            <form action="{{ route('users.restoreUser', $user->id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                    <button class="form-control btn btn-sm btn-primary">Geri Al</button>
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
            <div class="tab-pane fade" id="nav-not-completed" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>E-mail</th>
                                <th>Görevi</th>
                                <th>Durum</th>
                                <th>Aksiyon</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($non_users as $non_user)
                            <tr>
                                <th scope="row">{{ $non_user->id }}</th>
                                <td>{{ $non_user->email }}</td>
                                <td>
                                    @if($non_user->user_type == 'admin')
                                        Yönetici
                                    @elseif($non_user->user_type == 'competition-manager')
                                        Yarışma/Duyuru Sorumlusu
                                    @else
                                        İçerik Sorumlusu
                                    @endif
                                </td>
                                <td>Bekleniyor.</td>
                                <td>
                                    <div class="form-group">
                                        <a href="{{ route('users.edit', $non_user->id) }}" class="form-control btn btn-sm btn-primary">Güncelle</a>
                                        <form action="{{ route('users.destroy', $non_user->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE ')
                                            <button class="form-control btn btn-sm btn-danger">İptal Et</button>
                                        </form>
                                    </div>
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
