<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Patient;
use App\Admin;
use App\Http\Controllers\Controller;
use Cookie;
class AjaxRegistrationController extends Controller
{
    public function store(Request $request, Patient $patient){
    	$login = $request->input('login');
    	$email = $request->input('email');
    	$password = $request->input('password');
    	$age = $request->input('age');
    	$name = $request->input('name');
    	$errorEmail = ""; $errorLogin = "";
    	if($patient->isEmail($email))
    		$errorEmail = "This EMAIL was presented in database";
		if($patient->isLogin($login))
			$errorLogin = "This LOGIN was presented in database";
		if($errorEmail == "" && $errorLogin == ""){
    		$patient->insertIntoTable($login, $name, $password, $email, $age);
    		return 0;
		}
		return json_encode(array("log" => $errorLogin, "mail" => $errorEmail));
    }
    public function login(Request $request, Patient $patient){
    	$id = null;
    	$login = $request->input("login");
    	$password = $request->input("password");
    	$id = $patient->getId($login);
    	$isLoginAndEmail = $patient->loginAndPassword($login, $password);
    	if($isLoginAndEmail){
    		setcookie("cookiePatient", $login, time()+3600*24*30);
    		setcookie("cookieIdPatient", $id, time()+3600*24*30);
    		$value = $_COOKIE["cookiePatient"];
    		return json_encode(array('success' => 0, 'cookie' => $value));
    	}
    	return json_encode(array('success' => 1));
    }
    public function logOut(){
        setcookie("cookiePatient", " ", time()+3600*24*30);
		setcookie("cookieIdPatient", " ", time()+3600*24*30);
		return 0;
    }
}
