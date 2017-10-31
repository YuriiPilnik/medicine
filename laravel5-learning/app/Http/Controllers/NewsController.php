<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Home;

class NewsController extends Controller
{
    public function index(Home $home){
    	$news = $home->getNews();
    	return view("news", compact("news"));
    }
}
