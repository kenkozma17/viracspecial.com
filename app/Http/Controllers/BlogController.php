<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index() {
        $blogPosts = Blog::where('published', true)
            ->orderBy('published_date', 'asc')
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('pages.blog.index')->with('blogPosts', $blogPosts);
    }

    public function singlePost($slug) {
        $blogPost = Blog::where('url_slug', $slug)->first();

        return view('pages.blog.article')->with('blogPost', $blogPost);
    }

}
