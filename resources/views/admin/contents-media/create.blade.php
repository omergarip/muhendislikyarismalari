@extends('layouts.app')

@section('title')
    <title>Mühendislik Yarışmaları</title>
@endsection

@section('contents')

    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                {{ isset($media) ? 'Fotoğrafları Düzenle' :  'Fotoğrafları Yükle' }}
            </div>

            <div class="card-body">
                @foreach($media as $m)
                    <form action="{{ route('media.delete', $m->id) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger mr-2">Sil</button>
                        <img style="width: 10rem;" class="my-2 img-fluid" src="{{ asset('storage/'.$m->image) }}"/>
                        <span hidden id="{{ $m->id }}">{{ $m->image }}</span><br>
                    </form>


                @endforeach
                <div class="text-center mb-5">
                    {{ $media->links() }}
                </div>
                <form action="{{ route('media.store') }}" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                    @csrf

                </form>
                <a href="{{ isset($media) ? route(('contents.last-edit'), request()->route('id')) : route('contents.last') }}">Sonraki adim</a>
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
