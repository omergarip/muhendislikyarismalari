@extends('layouts.app')

@section('contents')

    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('series.create') }}" class="btn btn-success">Kategori Ekle</a>
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
                    @foreach($series as $cseries)
                        <tr>
                            <td>{{ $cseries->series_name }}</td>

                            <td>
                                <form action="{{ route('series.destroy', $cseries->id) }}" method="POST">
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
    <div class="text-center">
        {{ $series->links() }}
    </div>


@endsection
