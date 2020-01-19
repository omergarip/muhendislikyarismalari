@extends('layouts.app')

@section('contents')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-group">
                @foreach($errors->all() as $error)
                    <li class="list-group-item">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card card-default">
        <div class="card-header">
            {{ isset($competition) ? 'Edit Competition' :  'Create Competition' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($competition) ? route('competitions.update', $competition->id) : route('competitions.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($competition))
                    @method('PUT')
                @endif
                @if(isset($competition))
                    <div class="form-group">
                        <img src="{{ asset('/storage/'.$competition->image) }}" alt="" width="100%">
                    </div>
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="organizer">Organizer</label>
                    <input type="text" class="form-control" name="organizer" id="organizer" value="{{ isset($competition) ? $competition->organizer : '' }}">
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ isset($competition) ? $competition->title : '' }}">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input id="description" type="hidden" name="description" value="{{ isset($competition) ? $competition->description : '' }}">
                    <trix-editor class="trix-content" input="description"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="reward">Reward</label>
                    <input id="reward" type="hidden" name="reward" value="{{ isset($competition) ? $competition->reward : '' }}">
                    <trix-editor class="trix-content" input="reward"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="deadline">Deadline</label>
                    <input type="text" class="form-control" name="deadline" id="deadline" value="{{ isset($competition) ? $competition->deadline : '' }}">
                </div>
                <div class="form-group">
                    <label for="detail">Detail</label>
                    <input type="text" class="form-control" name="detail" id="detail" value="{{ isset($competition) ? $competition->detail : '' }}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success">
                        {{ isset($competition) ? 'Update Competition' : 'Create Competition' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection




@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
    <script>
        flatpickr("#deadline");
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
@endsection
