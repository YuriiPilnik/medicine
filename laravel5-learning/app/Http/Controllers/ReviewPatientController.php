<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class ReviewPatientController extends Controller
{
    public function index(Comment $comment){
    	$comments = $comment->getArrayComments(); 
    	return view("mentions",compact("comments"));
    }
    public function store(Request $request, Comment $comment){
    	$content = $request->input('comment');
    	$valuation = $request->input('valuation');
    	$login = $_COOKIE["cookiePatient"];
    	$id_patient = (int) $_COOKIE["cookieIdPatient"];
        $date = date("Y-m-d H:i:s"); 
    	$comment->insertIntoTable($content, $valuation, $login, $id_patient, $date);
		return json_encode(array("comment" => $content, "valuation" => $valuation, "date" => $date, "login" => $login));
    }
}
