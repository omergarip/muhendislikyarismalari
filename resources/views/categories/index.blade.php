@extends('layouts.app')

@section('contents')

    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('categories.create') }}" class="btn btn-success">Kategori Ekle</a>
    </div>

    <div class="card card-default">
        <div class="card-header">
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Kategori Adı</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->category_name }}</td>

                            <td>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>


@endsection
