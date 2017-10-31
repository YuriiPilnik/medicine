<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Patient extends Model
{
	public function isEmail($emailFind){
		$resfind = false;
		foreach (Patient::where('email', $emailFind)->cursor() as $login) 
			$resfind = true;
		return $resfind;
	}
	public function getId($login){
		foreach(Patient::where('login', $login)->cursor() as $current)
			$id = $current->id;
		return $id;
	}
	public function isLogin($loginFind){
		$resfind = false;
		foreach (Patient::where('login', $loginFind)->cursor() as $login) 
			$resfind = true;
		return $resfind;
	}
	public function loginAndPassword($login, $password){
		$resfind = false;
		foreach (Patient::where('login', $login)->where('passwd', $password)->cursor() as $login) 
			$resfind = true;
		return $resfind;
	}
    public function insertIntoTable($login, $name, $password, $email, $age){
		DB::table('patients')->insert([
    		['name' => $name, 
    		'email' => $email,
    		'login' => $login,
    		'passwd' => $password,
    		'age' => $age]
		]);		
	}
	public function getNameById($idPatient){
		foreach(Patient::where('id', $idPatient)->cursor() as $current)
			$name = $current->name;
		return $name;
	}	    
}
