@extends('layouts.dashboard')

@section('title')
    @if(isset($user))
        <title>Ekip Üyesinin Bilgilerini Güncelle</title>
    @else
        <title>Yeni Ekip Üyesi Ekle</title>
    @endif
@endsection

@section('contents')
    <div class="container w-25 my-5">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                        <li class="list-group-item">
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1 class="text-center">{{ isset($user) ? 'Ekip Üyesinin Bilgilerini Güncelle' : 'Yeni Ekip Üyesi Ekle' }}</h1>
        <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($user))
                @method('PUT')
            @endif
            <div class="input-group mr-2 mt-5 mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <input name="email" id="email" type="text" class="form-control" placeholder="E-mail Adresi" value="{{ isset($user) ? $user->email : '' }}">
            </div>
            <div class="form-group">
                <select name="user_type" id="select" class="form-control">
                    <option value="" selected disabled hidden>Ekip Üyesi Görevleri</option>
                    <option value="admin"
                            @if(isset($user))
                                @if($user->user_type == 'admin')
                                    selected
                                @endif
                            @endif>
                        Yönetici
                    </option>
                    <option value="competition-manager"
                            @if(isset($user))
                                @if($user->user_type == 'competition-manager')
                                    selected
                                @endif
                            @endif>
                        Yarışma/Duyuru Sorumlusu
                    </option>
                    <option value="content-manager"
                            @if(isset($user))
                                @if($user->user_type == 'content-manager')
                                    selected
                                @endif
                            @endif>
                        İçerik Sorumlusu
                    </option>
                </select>
            </div>
            <input type="submit" class="btn btn-primary" value="{{ isset($user) ? 'Güncelle' : 'Ekle' }}">
        </form>
    </div>
@endsection
