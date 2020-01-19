@extends('layouts.app')

@section('contents')
    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                Kategori Ekle
            </div>
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="category_name">Kategori Adı</label>
                        <input type="text" class="form-control" name="category_name" id="category_name">
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

