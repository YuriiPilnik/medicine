<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Post $postModel){
//        $post = Post::all();
//        dd($post);
//      $post = Post::latest('id')->get();
//        $post = Post::latest('published_at')->where('published_at','<=', Carbon:: now())->get();
        $post = $postModel->getPublishedPost();
        return view('post.index', ['posts' => $post]); 
    }   
}
