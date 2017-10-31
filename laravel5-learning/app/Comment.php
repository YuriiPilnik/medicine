<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Comment extends Model
{
	public function getArrayComments(){
		return Comment::orderBy('created_at', "DESC")->get();
	}
	 public function insertIntoTable($comment, $valuation, $login, $id_patient, $date){
		DB::table('comments')->insert([
    		['name_patient' => $login, 
    		'content' => $comment,
    		'valuation' => $valuation,
    		'id_patient' => $id_patient,
    		'created_at' => $date]
		]);		
	}
	public function getLastTimeInsert(){
		return Comment::all()->last()->pluck('created_at'); 
	}	    
}
