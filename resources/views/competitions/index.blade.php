@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('competitions.create') }}" class="btn btn-success">Add Competition</a>
    </div>

    <div class="card card-default">
        <div class="card-header">
            <div class="card-body">
                @if($competitions->count() > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($competitions as $competition)
                            <tr>
                                <td><img src="{{ asset('/storage/'.$competition->image) }}" width="120px" height="60px" alt=""></td>
                                <td>{{ $competition->title }}</td>
                                @if($competition->trashed())
                                    <td>
                                        <form action="{{ route('restore.competitions', $competition->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-info btn-sm">Restore</button>
                                        </form>
                                    </td>
                                @else
                                    <td>
                                        <a href="{{ route('competitions.edit', $competition->slug) }}" class="btn btn-info btn-sm">Edit</a>
                                    </td>
                                @endif

                                <td>
                                    <form action="{{ route('competitions.destroy', $competition->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            {{ $competition->trashed() ? 'Delete' : 'Trash' }}
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                @else
                    <h3 class="text-center">No Competitions Yet</h3>
                @endif
            </div>
        </div>
    </div>
@endsection
