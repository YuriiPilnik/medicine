<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Doctor extends Model
{
	public function isEmail($emailFind){
		$resfind = false;
		foreach (Doctor::where('email', $emailFind)->cursor() as $login) 
			$resfind = true;
		return $resfind;
	}
	public function getId($login){
		$id = null;
		foreach(Doctor::where('login', $login)->cursor() as $current)
			$id = $current->id;
		return $id;
	}
	public function isLogin($loginFind){
		$resfind = false;
		foreach (Doctor::where('login', $loginFind)->cursor() as $login) 
			$resfind = true;
		return $resfind;
	}
	public function loginAndPassword($login, $password){
		$resfind = false;
		foreach (Doctor::where('login', $login)->where('passwd', $password)->where("workingState", 1)->cursor() as $login) 
			$resfind = true;
		return $resfind;
	}
	public function insertIntoTable($name, $login, $email, $password, $phone, $characteristic, $specialty, $standing, $date){
		DB::table('doctors')->insert([
    		['fio' => $name, 
    		'email' => $email,
    		'login' => $login,
    		'passwd' => $password,
    		'description' => $characteristic,
    		'standing' => $standing,
    		'workingState' => 0,
    		'specialty' => $specialty,
    		'phone' => $phone,
    		'created_at' => $date]
		]);		
	}
	public function getRequisitions(){
		return Doctor::orderBy('id', "ASC")->where('workingState', 0)->get();
	}
	public function appendDoctor($idDoctor){
		return Doctor::where('id', $idDoctor)->update(array('workingState' => 1));
	}
	public function dropDoctor($idDoctor){
		return DB::table('doctors')->where('id', $idDoctor)->delete();
	}
	public function getWorkingDoctors(){
		return Doctor::orderBy('specialty', "ASC")->where('workingState', 1)->get();	
	}
	public function getArraySpecialtyDoctor(){
		$resarray = null;
		foreach(Doctor::where('workingState', 1)->cursor() as $current)
			$resarray[] = $current->specialty;
		return $resarray;
	}
}
