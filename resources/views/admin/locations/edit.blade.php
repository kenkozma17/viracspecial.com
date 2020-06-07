@extends('layouts.app')
@section('content')
@extends('auth.nav')
<div class="admin location edit content-mt">
    <div class="container mt-lg-5 mb-lg-5">
        <div class="card">
            <div class="card-body">
                <h2>Edit Location</h2>
                <form action="/auth/location/{{ $location->id }}" method="POST" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" value="{{ $location->title }}" name="title">
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" name="address">{{ $location->address }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Lat">Latitude</label>
                                <input class="form-control" type="text" name="lat" value="{{ $location->lat }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="Lng">Longitude</label>
                            <input class="form-control" type="text" name="lng" value="{{ $location->lng }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="summary">Content</label>
                        <textarea class="ckeditor" name="content">{{ $location->content }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="Website">Website/External URL</label>
                        <input class="form-control" type="text" name="website" value="{{ $location->website }}">
                    </div>

                    <div class="form-group">
                        <label for="image">Thumbnail</label>
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>

                    @if ($location->image)
                        <div class="form-group mt-3 mb-3">
                            <label for="image preview">Current Cover Image/Thumbnail</label>
                            <div>
                                <img class="image-preview" src="{{ $location->image }}" >
                            </div>
                        </div>
                    @endif

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" {{ $location->published ? 'checked' : '' }} name="published">
                        <label class="form-check-label" for="defaultCheck1">
                            Do you want to publish this location?
                        </label>
                    </div>

                    <div class="form-group mt-3">
                        <input type="submit" class="btn btn-success" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection