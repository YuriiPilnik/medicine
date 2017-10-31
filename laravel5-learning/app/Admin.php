<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
	public function getId($login){
		foreach(Admin::where('login', $login)->cursor() as $current)
			$id = $current->id;
		return $id;
	}
    public function loginAndPassword($login, $password){
    	$resfind = false;
		foreach (Admin::where('login', $login)->where('passwd', $password)->cursor() as $login) 
			$resfind = true;
		return $resfind;
    }
}
