@extends('layouts.app')
@section('content')
    <div class="container blog detail-page mb-5">
        <img class="cover-image" src="{{ $blogPost->image }}">
        <div class="article pb-5">
            <h2 class="title">{{ $blogPost->title }}</h2>
            <div class="details">
                <div class="date">{{ $blogPost->post_date }}</div>
                <div class="author">{{ $blogPost->author->name }}</div>
            </div>
            <div class="content mt-4">
                {!! $blogPost->content !!}
            </div>
        </div>
    </div>
@endsection