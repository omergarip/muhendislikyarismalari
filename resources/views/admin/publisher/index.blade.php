@extends('layouts.dashboard')

@section('title')
    <title>Yazarlar</title>
@endsection

@section('contents')
    <div class="container-fluid mt-5">
        <a href="{{ route('publisher.create') }}"
           class="btn btn-lg btn-primary my-5">
            Yeni Yazar Ekle
        </a>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Fotoğraf</th>
                        <th>İsim</th>
                        <th>Okul</th>
                        <th>Ünvan</th>
                        <th>Aksiyon</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($publishers as $publisher)
                        <tr>
                            <th scope="row">{{ $publisher->id }}</th>
                            <td>
                                @if($publisher->photo == '')
                                    <img src="https://www.pngkey.com/png/detail/230-2301779_best-classified-apps-default-user-profile.png">
                                @else
                                    <img src="{{ asset('storage/'.$publisher->photo) }}">
                                @endif
                            </td>
                            <td>{{ $publisher->fullname }}</td>
                            <td>{{ $publisher->school }} </td>
                            <td>{{ $publisher->title }}</td>
                            <td>
                                @if(@auth()->user()->user_type == 'admin')
                                    <div class="form-group">
                                        <a href="{{ route('publisher.edit', $publisher->id) }}" class="form-control btn btn-sm btn-primary">Güncelle</a>
                                        <form action="{{ route('publisher.delete', $publisher->id)}}" method="POST">
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
@endsection
