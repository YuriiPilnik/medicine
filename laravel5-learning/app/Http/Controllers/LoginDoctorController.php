<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\comment;
use App\write;
use Carbon\Carbon;

class LoginDoctorController extends Controller
{
	private $anwerRequest;
	private $pacientTrueFalse;
	public function setPacientTrueFalse($pacientTrueFalse)
	{
		$this->pacientTrueFalse = $pacientTrueFalse;
	}
	public function getPacientTrueFalse()
	{
		return $this->pacientTrueFalse;
	}
	public function setAnswerRequest($answer)
	{
		$this->anwerRequest = $answer;
	}
	public function getAnswerRequest()
	{
		return $this->anwerRequest;
	}
	public function getComments($id_doctor)
	{
		$array_contents = null;
		$comments = Comment::where('id_doctor', $id_doctor)->get();	
		foreach ($comments as $current)
		{	
		 	$array_contents[] = $current->content;
		}
		return $array_contents;
	}
	public function getCreate_at($id_doctor)
	{
		$array_created = null;
		$created = Comment::where('id_doctor', $id_doctor)->get();	
		foreach ($created as $current)
		{	
		 	$array_created[] = $current->created_at;
		}
		return $array_created;
	}
	public function getNamesPatient($id_doctor)
	{
		$array_names = null;
		$namesPatient = Comment::where('id_doctor', $id_doctor)->get();	
		foreach ($namesPatient as $current)
		{	
		 	$array_names[] = $current->name_pacient;
		}
		return $array_names;
	}
	public function getIdDoctor($login, $password)
	{
		foreach(Doctor::where('login', $login)->where('passwd', $password)->cursor() as $cur)
		{
			$IdDoctor = $cur->id;
		}
		return $IdDoctor;
	}
	public function loginAndPassword($login, $password)
	{
		$resfind = false;
		foreach (Doctor::where('login', $login)->where('passwd', $password)->cursor() as $login) 
		{
			$resfind = true;
		}
		return $resfind;
	}
	public function getArrayWritesDates($idDoctor)
	{
		$mytime = Carbon::now('Europe/Moscow')->addHours(1);
		$writesDates = null;
		foreach(Write::where('id_doctor', $idDoctor)->where('dates', '>=', $mytime)->orderBy('dates')->cursor() as $cur)
		{
			$writesDates[] = $cur->dates;
		}
		return $writesDates;
	}
    public function getArrayWritesDescription($idDoctor)
	{
		$mytime = Carbon::now('Europe/Moscow')->addHours(1);
		$writesDescription = null;
		foreach(Write::where('id_doctor', $idDoctor)->where('dates', '>=', $mytime)->orderBy('dates')->cursor() as $cur)
		{
			$writesDescription[] = $cur->description;
		}
		return $writesDescription;
	}
    public function getArrayWritesType($idDoctor)
	{
		$writesType = null;
		$mytime = Carbon::now('Europe/Moscow')->addHours(1);
		foreach(Write::where('id_doctor', $idDoctor)->where('dates', '>=', $mytime)->orderBy('dates')->cursor() as $cur)
		{
			$writesType[] = $cur->type;
		}
		return $writesType;
	}
    public function getArrayWritesName($idDoctor)
	{
		$writesNames = null;
		$mytime = Carbon::now('Europe/Moscow')->addHours(1);
		foreach(Write::where('id_doctor', $idDoctor)->where('dates', '>=', $mytime)->orderBy('dates')->cursor() as $cur)
		{
			$writesNames[] = $cur->name_pacient;
		}
		return $writesNames;
	}
	
    public function create()
	{
		$this->setAnswerRequest(0);
		return view('login.signinDoctor', ['answer' => $this->getAnswerRequest()]);
	}
	public function changeWorkingState($idDoctor)
	{
		$doctor = Doctor::where('id', $idDoctor)->get();	
		foreach ($doctor as $current)
		{	
		 	$workState = $current->workingState;
		}
		return $workState;
	}
	public function store(Request $request)
	{
		$login = $request->input('login2');
		$password = $request->input('passwd2');
		if($password == '' || $login == '')
		{
//			if anything is empty 
			$this->setAnswerRequest(1);
			return view('login.signinDoctor', ['answer' => $this->getAnswerRequest()]); 
		}
		else if($this->loginAndPassword($login, $password))
		{
//			if found password and login
			$idDoctor = $this->getIdDoctor($login, $password);
			$arrayWritesDates = $this->getArrayWritesDates($idDoctor);
			$arrayWritesDescriptions = $this->getArrayWritesDescription($idDoctor);
			$arrayWritesTypes = $this->getArrayWritesType($idDoctor);
			$arrayWritesNames = $this->getArrayWritesName($idDoctor);
			
			$array_comments = $this->getComments($idDoctor);
			$array_create = $this->getCreate_at($idDoctor);
			$array_namePatient = $this->getNamesPatient($idDoctor);
			
			
			$workState = $this->changeWorkingState($idDoctor);
			$this->setPacientTrueFalse(false);
			return view('login.room', ['patient' => $this->getPacientTrueFalse(), 'array_dates' => $arrayWritesDates, 'array_types' => $arrayWritesTypes, 'array_description' => $arrayWritesDescriptions, 'array_names' => $arrayWritesNames, 'loginDoctor' => $login, 'array_comment' => $array_comments, 'array_create' => $array_create, 'arrayNamePatient' => $array_namePatient,'idDocotor' => $idDoctor, 'workState' => $workState]);
		}
		else
		{
//			if not found password or login
			$this->setAnswerRequest(2);
			return view('login.signinDoctor', ['answer' => $this->getAnswerRequest()]);
		}		 
	}
}
