@extends('layouts.dashboard')

@section('title')
    <title>{{ isset($publisher) ? 'Düzenle' :  'Yazar Ekle' }}</title>
@endsection

@section('contents')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                {{ isset($publisher) ? 'Düzenle' :  'Yazar Ekle' }}
            </div>
            <div class="card-body">
                <form action="{{ isset($publisher) ? route('publisher.update', $publisher->id) : route('publisher.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($publisher))
                        @method('PUT')
                    @endif
                    <div id="list">
                        @if(isset($publisher))
                            <div class="form-group">
                                <img src="{{ asset('storage/'.$publisher->photo) }}" alt="" style="width: 6rem; height: 6rem;">
                            </div>
                        @endif
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="photo" id="customFilecover">
                            <label class="custom-file-label" for="customFilecover">Profil Fotoğrafı Seç</label>
                        </div>
                        <div class="form-group mt-3">
                            <label for="fullname"><span class="FieldInfo">Yazarın İsmi ve Soyismi:</span></label>
                            <input class="form-control" type="text" name="fullname" id="fullname" value="{{ isset($publisher) ? $publisher->fullname : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="title"><span class="FieldInfo">Ünvan:</span></label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ isset($publisher) ? $publisher->title : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="school"><span class="FieldInfo">Okul:</span></label>
                            <input class="form-control" type="text" name="school" id="school" value="{{ isset($publisher) ? $publisher->school : '' }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">
                            {{ isset($publisher) ? 'Düzenle' : 'Yazar Ekle' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection


