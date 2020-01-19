@extends('layouts.app')

@section('contents')
    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                Kategori Ekle
            </div>
            <div class="card-body">
                <form action="{{ route('series.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="cover" id="customFilecover">
                        <label class="custom-file-label" for="customFilecover">Kapak Fotoğrafı Seç</label>
                    </div>
                    <div class="form-group">
                        <label for="series_name">Seri Adı</label>
                        <input type="text" class="form-control" name="series_name" id="series_name">
                    </div>
                    <div class="form-group">
                        <label for="link">Seri Adı</label>
                        <input type="text" class="form-control" name="link" id="link">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">
                            Kategori Ekle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

