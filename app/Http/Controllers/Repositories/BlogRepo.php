<?php

namespace App\Http\Controllers\Repositories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogRepo extends Controller
{

    # Slugify a string
    public function createSlug($value) {
        return Str::slug($value, '-');
    }
}
