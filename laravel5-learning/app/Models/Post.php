<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    public function getPublishedPost()
    {
        $post = Post::latest('published_at')->where('published_at','<=', Carbon:: now())->where('published', '=', 1)->get();
        return $post;
    }
}
