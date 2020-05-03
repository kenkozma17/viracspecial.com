<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog_posts';
    protected $fillable = ['title', 'url_slug', 'summary', 'content', 'image', 'published_date', 'published', 'user_id', 'local_author'];
    protected $appends = ['author_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getAuthorNameAttribute() {
        if(parent::has('author')->get()) {
            return $this->author->name;
        }
        return null;
    }
}
