@extends('layouts.app')

@section('contents')
    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                {{ isset($content) ? 'Fotoğrafları Düzenle' :  'Fotoğrafları Yükle' }}
            </div>
            <div class="card-body">
                <form action="{{ route('contents.sstore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="custom-file">
                        <input multiple type="file" class="custom-file-input" name="image" id="customFilecover">
                        <label  class="custom-file-label" for="customFilecover">Kapak Fotoğrafı Seç</label>
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

