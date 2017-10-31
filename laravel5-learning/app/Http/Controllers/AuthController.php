<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\patient;
class AuthController extends Controller
{
 	private $error;
	private $name;
	public function setStateError($error)
	{
		$this->error = $error;
	}
	public function getName()
	{
		return $this->name;	
	}
	public function getError()
	{
		return $this->error;
	}
    public function index()
    {
        return view('auth.registration');
    }
	public function create()
	{
		$this->setStateError(0);
		return view('auth.registration', ['error' => $this->getError()]);
	}
	public function isEmail($emailFind)
	{
		$resfind = false;
		foreach (Patient::where('email', $emailFind)->cursor() as $email) 
		{
			$resfind = true;
		}
		return $resfind;
	}
	public function isLogin($loginFind)
	{
		$resfind = false;
		foreach (Patient::where('login', $loginFind)->cursor() as $login) 
		{
			$resfind = true;
		}
		return $resfind;
	}
	public function store(Request $request)
	{
		$pat = new patient;
		$this->name = $request->input('name');
		$email = $request->input('email');
		$password1 = $request->input('password1');
		$password2 = $request->input('password2');
		$age = $request->input('age');
		$login = $request->input('login');
		
		if($this->name == '' || $email == '' || $password1 == '' || $password2 == '' || $age == '' || $login == '')
		{
//			if anything is Empty
			$this->setStateError(2);
			return view('auth.registration', ['error' => $this->getError()]);
		}
		if($password1 != $password2)
		{
//			if passwords is not equal
			$this->setStateError(4);
			return view('auth.registration', ['error' => $this->getError()]);
		}
		if ($this->isEmail($email) || $this->isLogin($login))
		{
//			if email or login presented in database
			$this->setStateError(3);
			return view('auth.registration', ['error' => $this->getError()]);
		}
//		all right
		$this->setStateError(1);
		$pat->name = $request->input('name');
		$pat->email = $request->input('email');	
		$pat->passwd = $request->input('password1');
		$pat->age = $request->input('age');
		$pat->login = $request->input('login');
		$pat->access_comment = 1;
		$pat->save();	
		return view('auth.registration', ['error' => $this->getError(), 'name' => $this->getName()]);
	}
//	 for definition true if email is presented in the database
	
}
