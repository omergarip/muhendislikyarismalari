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
            {{ isset($announcement) ? 'Edit Announcements' :  'Create Announcements' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($announcement) ? route('announcements.update', $announcement->id) : route('announcements.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($announcement))
                    @method('PUT')
                @endif
                @if(isset($announcement))
                    <div class="form-group">
                        <img src="{{ asset('/storage/'.$announcement->image) }}" alt="" width="100%">
                    </div>
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="organizer">Organizer</label>
                    <input type="text" class="form-control" name="organizer" id="organizer" value="{{ isset($announcement) ? $announcement->organizer : '' }}">
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ isset($announcement) ? $announcement->title : '' }}">
                </div>
                <div class="form-group">
                    <label for="categorySelect"><span class="FieldInfo">Seri Sec:</span></label>
                    <select class="form-control" name="category_slug" id="categorySelect">
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input id="description" type="hidden" name="description" value="{{ isset($announcement) ? $announcement->description : '' }}">
                    <trix-editor class="trix-content" input="description"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="reward">Reward</label>
                    <input id="reward" type="hidden" name="reward" value="{{ isset($announcement) ? $announcement->reward : '' }}">
                    <trix-editor class="trix-content" input="reward"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="deadline">Deadline</label>
                    <input type="text" class="form-control" name="deadline" id="deadline" value="{{ isset($announcement) ? $announcement->deadline : '' }}">
                </div>
                <div class="form-group">
                    <label for="detail">Detail</label>
                    <input type="text" class="form-control" name="detail" id="detail" value="{{ isset($announcement) ? $announcement->detail : '' }}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success">
                        {{ isset($competition) ? 'Update Announcement' : 'Create Announcement' }}
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
