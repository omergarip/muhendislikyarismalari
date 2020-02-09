@extends('layouts.app')

@section('contents')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <div class="card card-default">
                        <div class="card-header">
                            Fotograflar
                        </div>
                        <div class="card-body">
                            @foreach($medias as $media)
                                <input type="radio" id="radiobutton" name="images" value="{{ $media->id }}">
                                <img width="50rem" height="20rem" class="my-2 img-fluid" src="{{ asset('storage/'.$media->image) }}"/>
                                <span hidden id="{{ $media->id }}">{{ $media->image }}</span><br>
                            @endforeach
                            <button id="selectImage">Foto ekle</button>
                            <button id="addHr">Serit ekle</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="card card-default">
                        <div class="card-header">
                            {{ isset($content) ? 'İçeriği Düzenle' :  'İçeriği Yükle' }}
                        </div>
                        <div class="card-body">
                            <form action="{{ isset($content) ? route('contents.last-update', $content->slug) : route('contents.last-store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input id="content_title" type="text" hidden value="{{ $title }}">
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" name="text" id="summernote">{{ isset($content) ? $content->text : '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success">
                                        {{ isset($content) ? 'Düzenle' : 'Ekle' }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.js"></script>
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 700,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
    <script>
        $("#selectImage").click(() => {

            var id = $("input[name='images']:checked").val();
            src = $('#'+id).text();
            $('#'+id).css('text-decoration', 'line-through')
            var info = $('#summernote').summernote('code');
            var content_title = $("#content_title").val();
            $('#summernote').summernote('code', info +"<img class='my-2 img-fluid' src='/storage/" + src + "' alt='" + content_title + "'/>\n");


        });

        $("#addHr").click(() => {
            var info = $("trix-editor").text();
            $("trix-editor").html(info + "\n<hr style='border: 1px solid black;'>");
        })
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        img {
            max-width: 60rem!important;
        }
    </style>
@endsection


{{--@extends('layouts.app')--}}

{{--@section('title')--}}
{{--    <title>Summernote with Bootstrap 4</title>--}}
{{--@endsection--}}

{{--@section('contents')--}}
{{--    <div class="container-fluid">--}}
{{--        <div class="row">--}}
{{--            <div class="col-sm-2">--}}
{{--                <div class="card card-default">--}}
{{--                    <div class="card-header">--}}
{{--                        Fotograflar--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        @foreach($medias as $media)--}}
{{--                            <input type="radio" id="radiobutton" name="images" value="{{ $media->id }}">--}}
{{--                            <img width="50rem" height="20rem" class="my-2 img-fluid" src="{{ asset('storage/'.$media->image) }}"/>--}}
{{--                            <span hidden id="{{ $media->id }}">{{ $media->image }}</span><br>--}}
{{--                        @endforeach--}}
{{--                        <button id="selectImage">Foto ekle</button>--}}
{{--                        <button id="addHr">Serit ekle</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-sm-10">--}}
{{--                <div class="card card-default">--}}
{{--                    <div class="card-header">--}}
{{--                        {{ isset($content) ? 'Fotoğrafları Düzenle' :  'Fotoğrafları Yükle' }}--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <form action="{{ isset($content) ? route('contents.update', $content->slug) : route('contents.lupdate') }}" method="post" enctype="multipart/form-data">--}}
{{--                            @csrf--}}
{{--                            @method('put')--}}
{{--                            <input id="content_title" type="text" hidden value="{{ $title }}">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="content">Content</label>--}}
{{--                                <textarea class="form-control" name="" id="summernote" cols="30" rows="10">{{ isset($content) ? $content->text : '' }}</textarea>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <button class="btn btn-success">--}}
{{--                                    Icerik ekle--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    --}}
{{--@endsection--}}

{{--@section('scripts')--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.js"></script>--}}
{{--    <script>--}}
{{--        $('#summernote').summernote({--}}
{{--            placeholder: 'Hello Bootstrap 4',--}}
{{--            tabsize: 2,--}}
{{--            height: 100--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}

{{--@section('css')--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.css" rel="stylesheet">--}}
{{--@endsection--}}




