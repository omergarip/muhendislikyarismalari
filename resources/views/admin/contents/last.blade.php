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
                            <button class="btn btn-warning" id="selectImage">Foto ekle</button>
                            <button class="btn btn-danger" id="addHr">Serit ekle</button>
                        </div>
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                            Alıntı
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input class="form-control mb-2" type="text" id="quote" name="quote" placeholder="Sözü buraya yazın.">
                                <input class="form-control mb-2" type="text" id="sayer" name="sayer" placeholder="Sözü söyleyen kişiyi buraya yazın.">
                                <input class="form-control mb-2" type="text" id="color-code" name="color-code" placeholder="Renk kodunu yazın.">
                            </div>

                            <button class="btn btn-primary" id="addQuote">Alıntı ekle</button>
                        </div>
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                            Youtube
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input class="form-control mb-2" type="text" id="youtube" name="quote" placeholder="Youtube linki.">
                            </div>
                            <button class="btn btn-primary" id="addYoutube">Ekle</button>
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
                ['font', ['bold', 'underline', 'italic', 'clear']],
                ['color', ['color']],
                ['fontsize', ['fontsize']],
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
            var info = $('#summernote').summernote('code');
            $('#summernote').summernote('code', info + "\n<hr style='border: 1px solid black;'>");
        });
        $("#addQuote").click(() => {
            var info = $('#summernote').summernote('code');
            var quote = $('#quote').val();
            var sayer = $('#sayer').val();
            var color = $('#color-code').val();
            $('#summernote').summernote('code', info +
                "\n<div style='text-align: justify; width: 100%;'>\n" +
                "<div class=\"border border-dark\" style=\"display: inline-block;  background-color:" + color + "; border-radius: 15px;\"><br>\n" +
                "<p class='px-3 first' style='height: 0;'><em>\"" + quote + "</em></p><br>" +
                "<span class=\"float-right py-2 px-3\"><strong><em>" + sayer + "</em></strong></span><br>" +
                "</div></div>");
            $('#quote').val('');
            $('#sayer').val('');
            $('#sayer').val('');
        });
        $("#addYoutube").click(() => {
            var info = $('#summernote').summernote('code');
            var youtube = $('#youtube').val();
            $('#summernote').summernote('code', info + "\n" + youtube);
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



