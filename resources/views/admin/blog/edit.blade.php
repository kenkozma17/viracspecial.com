@extends('layouts.app')
@section('content')
@extends('auth.nav')
<div class="admin blog">
    <div class="container mt-lg-5 mb-lg-5">
        <div class="card">
            <div class="card-body">
                <h2>Edit Blog Post</h2>
                <form action="/auth/blog/{{ $blogPost->id }}" method="POST" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" value="{{ $blogPost->title }}" name="title">
                    </div>

                    <div class="form-group">
                        <label for="summary">Summary</label>
                        <textarea class="ckeditor" name="summary">
                            {{ $blogPost->summary }}
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label for="summary">Content</label>
                        <textarea class="ckeditor" name="content">
                            {{ $blogPost->content }}
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label for="Published Date">Published Date</label><br>
                        <input type="date" name="published_date" value="{{ $blogPost->published_date }}">
                    </div>

                    <div class="form-group">
                        <label for="image">Cover Image/Thumbnail</label>
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>

                    @if ($blogPost->image)
                        <div class="form-group mt-3 mb-3">
                            <label for="image preview">Current Cover Image/Thumbnail</label>
                            <div>
                                <img class="image-preview" src="{{ $blogPost->image }}" >
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="Local Author">Author</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Options</label>
                                    </div>
                                    <select class="custom-select" name="user_id">
                                        @foreach ($users as $user)
                                            <option {{ $user->id === $blogPost->user_id ? 'selected' : ''}} value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="Local Author">Local Author</label>
                                <input class="form-control" type="text" name="local_author" value="{{ $blogPost->local_author }}">
                                <small class="form-text text-muted">If value is present, this will take priority over main author. Use this field to publish posts of local authors.</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" {{ $blogPost->published ? 'checked' : '' }} name="published">
                        <label class="form-check-label" for="defaultCheck1">
                            Do you want to publish this post?
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