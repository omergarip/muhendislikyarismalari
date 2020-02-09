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
                {{ isset($announcement) ? 'Duyuruyu Güncelle' :  'Duyuru Ekle' }}
            </div>
            <div class="card-body">
                <form action="{{ isset($announcement) ? route('announcements.update', $announcement->id) : route('announcements.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($announcement))
                        @method('PUT')
                    @endif
                    @if(isset($announcement))
                        <div class="form-group">
                            <img src="{{ asset('/storage/'.$announcement->image) }}" alt="" width="100%">
                        </div>
                    @endif
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="customFilecover">
                        <label class="custom-file-label" for="customFilecover">Kapak Fotoğrafı Seç</label>
                    </div>
                    <div class="form-group">
                        <label for="organizer">Kurum</label>
                        <input type="text" class="form-control" name="organizer" id="organizer" value="{{ isset($announcement) ? $announcement->organizer : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="title">Başlık</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ isset($announcement) ? $announcement->title : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="categorySelect"><span class="FieldInfo">Kategori Sec</span></label>
                        <select class="form-control" name="category_slug" id="categorySelect">
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}"
                                        @if(isset($announcement))
                                            @if($category->slug == $announcement->category_slug)
                                                selected
                                            @endif
                                        @endif
                                >{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="content">Tanıtım Metni</label>
                        <input id="description" type="hidden" name="description" value="{{ isset($announcement) ? $announcement->description : '' }}">
                        <trix-editor class="trix-content" input="description"></trix-editor>
                    </div>
                    <div class="form-group">
                        <label for="reward">Ödül</label>
                        <input id="reward" type="hidden" name="reward" value="{{ isset($announcement) ? $announcement->reward : '' }}">
                        <trix-editor class="trix-content" input="reward"></trix-editor>
                    </div>
                    <div class="form-group">
                        <label for="deadline">Son Başvuru Tarihi</label>
                        <input type="text" class="form-control" name="deadline" id="deadline" value="{{ isset($announcement) ? $announcement->deadline : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="detail">Detaylı Bilgi</label>
                        <input type="text" class="form-control" name="detail" id="detail" value="{{ isset($announcement) ? $announcement->detail : '' }}">
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
