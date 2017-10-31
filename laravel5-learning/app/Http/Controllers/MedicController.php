<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Doctor;
use App\Write;
class MedicController extends Controller
{
    public function index(Write $write){
    	$date = date('Y-m-d H:i:s');
    	$idDoctor = $_COOKIE["cookieIdMedic"];
    	$writes = $write->getWritesForDoctor($idDoctor, $date);
    	return view("medic", compact("writes"));
    }
    public function store(Request $request, Doctor $doctor){
    	$name = $request->input("name");
    	$login = $request->input("login");
    	$email = $request->input("email");
    	$password = $request->input("password");
    	$phone = $request->input("phone");
    	$characteristic = $request->input("characteristic");
    	$specialty = $request->input("specialty");
    	$standing = $request->input("standing");
    	$errorEmail = ""; $errorLogin = "";
		$date = date("Y-m-d H:i:s"); 
    	if($doctor->isEmail($email))
    		$errorEmail = "This EMAIL was presented in database";
		if($doctor->isLogin($login))
			$errorLogin = "This LOGIN was presented in database";
		if($errorEmail == "" && $errorLogin == ""){
    		$doctor->insertIntoTable($name, $login, $email, $password, $phone, $characteristic, $specialty, $standing, $date);
    		return 0;
		}
		return json_encode(array("log" => $errorLogin, "mail" => $errorEmail));
    }
    public function login(Request $request, Doctor $doctor){
    	$id = null;
    	$login = $request->input("login");
    	$password = $request->input("password");
    	$id = $doctor->getId($login);
    	$isLoginAndEmail = $doctor->loginAndPassword($login, $password);
    	if($isLoginAndEmail){
    		setcookie("cookieMedic", $login, time()+3600*24*30);
    		setcookie("cookieIdMedic", $id, time()+3600*24*30);
    		$value = $_COOKIE["cookieMedic"];
    		return json_encode(array('success' => 0, 'cookie' => $value));
    	}
    	return json_encode(array('success' => 1));
    }
    public function logOut(){
    	setcookie("cookieMedic", " ", time()+3600*24*30);
		setcookie("cookieIdMedic", " ", time()+3600*24*30);
		return 0;
    }
    public function appendDoctor(Request $request, Doctor $doctor){
    	$id = $request->input("idDoctor");
    	$doctor->appendDoctor($id);
    	$requests = $doctor->getRequisitions();
    	return view("support", compact("requests"));
    }
   	public function dropDoctor(Request $request, Doctor $doctor){
   		$id = $request->input("idDoctor");
   		$doctor->dropDoctor($id);
    	$requests = $doctor->getRequisitions();
    	return view("support", compact("requests"));
   	}
   	public function submitConslution(Request $request, Write $write){
   		$idWrite = $request->input("idWrite");
   		$note = $request->input("note");
   		$diagnoz = $request->input("diagnoz");
   		$write->updateTable($idWrite, $note, $diagnoz);
   		return 0;
   	}
}
