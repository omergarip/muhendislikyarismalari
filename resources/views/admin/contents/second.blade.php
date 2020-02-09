@extends('layouts.app')

@section('title')
    <title>Mühendislik Yarışmaları</title>
@endsection

@section('contents')

    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                {{ isset($content) ? 'Fotoğrafları Düzenle' :  'Fotoğrafları Yükle' }}
            </div>
            <div class="card-body">
                <form action="{{ route('contents.sstore') }}" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                    @csrf
                </form>
                <a href="{{ route('contents.last') }}">Sonraki adim</a>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/dropzone.min.js') }}"></script>
    <script>
        Dropzone.options.myDropzone = {
            paramName: 'file',
            maxFilesize: 5, // MB
            maxFiles: 20,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
        };
    </script>
@endsection
