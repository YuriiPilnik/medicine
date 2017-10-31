<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Home;
use App\Doctor;

class SupportController extends Controller
{
    public function index(Doctor $doctor){
    	$requests = $doctor->getRequisitions();
    	return view("support", compact("requests"));
    }
    public function loginSupport(Request $request, Admin $admin){
        $login = $request->input("login");
        $id = $admin->getId($login);
        $password = $request->input("password");
        if($admin->loginAndPassword($login, $password)){
        	setcookie("cookieIdSupport", $id, time()+3600*24*30);
            setcookie("cookieSupport", $login, time()+3600*24*30);
            return json_encode(array('success' => 0));
        }
        return json_encode(array('success' => 1));
    }
    public function logOut(){
    	setcookie("cookieSupport", " ", time()+3600*24*30);
    }
    public function publicNews(Request $request, Home $home){
    	$title = $request->input("title");
    	$news = $request->input("news");
    	$id_admin = (int) $_COOKIE["cookieIdSupport"];
    	$date = date("Y-m-d H:i:s"); 
    	$home->insertIntoTable($news, $title, $id_admin, $date);
    	return "ok";
    }
}
