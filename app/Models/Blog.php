<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog_posts';
    protected $fillable = ['title', 'url_slug', 'summary', 'content', 'image', 'published_date', 'user_id'];
}
