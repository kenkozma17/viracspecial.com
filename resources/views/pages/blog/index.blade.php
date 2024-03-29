@extends('layouts.app')
@section('title', 'Virac Special | Blog')
@section('content')
    <div class="container blog list content-mt">
        @if(count($blogPosts))
            <div class="title">Latest blog posts</div>
            <div class="row">
                @foreach($blogPosts as $post)
                    <div class="col-sm-6 mt-3 mb-3">
                        <a class="card-holder" href="/vs-blog/{{ $post->url_slug }}">
                            <div class="image" style="background-image: linear-gradient(to bottom,rgba(0,0,0,0),rgba(0,0,0,0.6)), url({{ $post->image }})">
                                <div class="title-container">
                                    <div class="title">{{ $post->title }}</div>
                                    <div class="author">{{ $post->author->name }}</div>
                                </div>
                                <a href="/vs-blog/{{ $post->url_slug }}" class="read-more">
                                    Read More
                                </a>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            {{ $blogPosts->links() }}
        @else
            <div class="title">No blog posts yet!</div>
        @endif
    </div>
@endsection