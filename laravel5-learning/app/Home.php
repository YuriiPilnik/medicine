<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Home extends Model
{
    public function insertIntoTable($news, $title, $id_admin, $date){
    	DB::table('homes')->insert([
    		['title' => $title, 
    		'content' => $news,
    		'id_admin' => $id_admin,
    		'created_at' => $date]
		]);		
    }
    public function getNews(){
    	return Home::orderBy('created_at', "ASC")->get();
    }
}
