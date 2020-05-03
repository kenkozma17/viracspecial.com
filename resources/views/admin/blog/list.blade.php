@extends('layouts.app')
@section('content')
@extends('auth.nav')
    <div class="admin blog">
        <div class="container mt-lg-5">
            <div class="row">
                <div class="col-lg-6">
                    <h2>Blog Posts</h2></div>
                <div class="col-lg-6 text-right">
                    <a href="/auth/blog/create" class="btn btn-success">Create Blog Post</a>
                </div>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Actions</th>
                        <th scope="col">Title</th>
                        <th scope="col">Published</th>
                    </tr>
                </thead>
                @if (count($posts))
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th scope="row">
                                <a href="#" class="btn btn-primary">Edit</a>
                            </th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->published }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th>There are no blog posts right now! Well, get busy and start writing!</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection