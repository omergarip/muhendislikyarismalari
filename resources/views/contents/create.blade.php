@extends('layouts.app')

@section('contents')
    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                {{ isset($content) ? 'İçerik Düzenle' :  'İçerik Ekle' }}
            </div>
            <div class="card-body">
                <form action="{{ isset($content) ? route('contents.update', $content->slug) : route('contents.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(isset($content))
                        @method('PUT')
                    @endif
                    <div id="list">
                        @if(isset($content))
                            <div class="form-group">
                                <img src="{{ asset('/'.$content->cover) }}" alt="" style="width: 6rem; height: 6rem;">
                            </div>
                        @endif
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="cover" id="customFilecover">
                            <label class="custom-file-label" for="customFilecover">Kapak Fotoğrafı Seç</label>
                        </div>
                        <div class="form-group">
                            <label for="page_title"><span class="FieldInfo">Başlık:</span></label>
                            <input class="form-control" type="text" name="page_title" id="page_title" value="{{ isset($content) ? $content->page_title : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="title"><span class="FieldInfo">Link:</span></label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ isset($content) ? $content->title : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="description"><span class="FieldInfo">Tanıtım:</span></label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ isset($content) ? $content->description : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="publisher_id"><span class="FieldInfo">Yazar Sec:</span></label>
                            <select class="form-control" name="publisher_id" id="publisher_id">
                                <option selected value="0">Mühendislik Yarışmaları</option>
                                @foreach($publishers as $publisher)
                                    <option value="{{ $publisher->id }}"
                                        @if(isset($content))
                                            @if($publisher->id == $content->publisher_id)
                                                selected
                                            @endif
                                        @endif
                                    >
                                        {{ $publisher->fullname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categorySelect"><span class="FieldInfo">Seri Sec:</span></label>
                            <select class="form-control" name="series_link" id="categorySelect">
                                @foreach($series as $cseries)
                                    <option value="{{ $cseries->link }}"
                                        @if(isset($content))
                                            @if($cseries->link == $content->series_link)
                                                selected
                                            @endif
                                        @endif
                                    >
                                        {{ $cseries->series_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">
                            Icerik ekle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
@endsection

