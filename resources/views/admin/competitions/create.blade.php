@extends('layouts.dashboard')

@section('title')
    <title>Mühendislik Yarışmaları</title>
@endsection
@section('contents')
    <div class="container-fluid">
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
        <div class="card card-default">
            <div class="card-header">
                {{ isset($competition) ? 'Yarışmayı Düzenle' :  'Yeni Yarışma Ekle' }}
            </div>
            <div class="card-body">
                <form action="{{ isset($competition) ? route('competitions.update', $competition->id) : route('competitions.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($competition))
                        @method('PUT')
                    @endif
                    @if(isset($competition))
                        <div class="form-group">
                            <img style="width: 10rem; height: 10rem;" src="{{ asset('/storage/'.$competition->image) }}" alt="" width="100%">
                        </div>
                    @endif
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="customFilecover">
                        <label class="custom-file-label" for="customFilecover">Kapak Fotoğrafı Seç</label>
                    </div>
                    <div class="form-group">
                        <label for="organizer">Kurum</label>
                        <input type="text" class="form-control" name="organizer" id="organizer" value="{{ isset($competition) ? $competition->organizer : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="title">Başlık</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ isset($competition) ? $competition->title : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="content">Tanıtım Metni</label>
                        <input id="description" type="hidden" name="description" value="{{ isset($competition) ? $competition->description : '' }}">
                        <trix-editor class="trix-content" input="description"></trix-editor>
                    </div>
                    <div class="form-group">
                        <label for="reward">Ödül</label>
                        <input id="reward" type="hidden" name="reward" value="{{ isset($competition) ? $competition->reward : '' }}">
                        <trix-editor class="trix-content" input="reward"></trix-editor>
                    </div>
                    <div class="form-group">
                        <label for="deadline">Son Başvuru Tarihi</label>
                        <input type="text" class="form-control" name="deadline" id="deadline" value="{{ isset($competition) ? $competition->deadline : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="detail">Detaylı Bilgi</label>
                        <input type="text" class="form-control" name="detail" id="detail" value="{{ isset($competition) ? $competition->detail : '' }}">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">
                            {{ isset($competition) ? 'Güncelle' : 'Ekle' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection




@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
    <script>
        flatpickr("#deadline");
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
@endsection
