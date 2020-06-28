<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $fillable = ['title', 'lat', 'lng', 'content', 'address', 'published', 'order', 'website', 'image'];
    protected $appends = ['limited_content'];

    public function getLimitedContentAttribute() {
        return substr($this->content, 0, 150) . '...';
    }
}
