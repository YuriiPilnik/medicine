<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comment;
use App\patient;

class CommentPatientController extends Controller
{
	private $error;
	public function setStateError($error)
	{
		$this->error = $error;
	}
	public function getStateError()
	{
		return $this->error;
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
	public function accessComment($id_patient)
	{
		$access_comment = null;
		foreach(Patient::where('id', $id_patient)->cursor() as $current)
		{
			$access_comment = $current->access_comment;
		}
		return $access_comment;
	}
    public function create(Request $request)
	{
		$id_patient = $request->input('idPatient');
		if($this->accessComment($id_patient) == 1)
		{
			$id_doctor = $request->input('idDoctor');
			$name_patient = $request->input('namePatient');
			$array_comments = $this->getComments($id_doctor);
			$array_create = $this->getCreate_at($id_doctor);
			$array_namePatient = $this->getNamesPatient($id_doctor);
			if(count($array_comments) >=1)
			{
				$array_comments = array_reverse($array_comments);
				$array_create = array_reverse($array_create);
				$array_namePatient = array_reverse($array_namePatient);
			}
			$this->setStateError(0);
			return view('login.comment', ['idDoctor' => $id_doctor, 'idPatient' => $id_patient, 'namePatient' => $name_patient, 'array_comment' => $array_comments, 'array_create' => $array_create, 'arrayNamePatient' => $array_namePatient, 'error' => $this->getStateError()]);
		}
		else if($this->accessComment($id_patient) == 0)
		{
			return view('login.disableAccessWriteComment');
		}
	}	
	public function store(Request $request)
	{
		$id_doctor = $request->input('idDoctor');
		$id_patient = $request->input('idPatient');
		$name_patient = $request->input('namePatient');
		$array_comments = $this->getComments($id_doctor);
		
		$array_create = $this->getCreate_at($id_doctor);
		$array_namePatient = $this->getNamesPatient($id_doctor);
		if($request->input('comment') == '')
		{
			$this->setStateError(1);
			return view('login.comment', ['idDoctor' => $id_doctor, 'idPatient' => $id_patient, 'namePatient' => $name_patient, 'array_comment' => $array_comments, 'array_create' => $array_create, 'arrayNamePatient' => $array_namePatient, 'error' => $this->getStateError()]); 
		}
		$commSubmitToBase = new comment;
		$commSubmitToBase->content = $request->input('comment');
		$commSubmitToBase->name_pacient = $request->input('namePatient');
		$commSubmitToBase->id_patient = $request->input('idPatient');
		$commSubmitToBase->id_doctor = $request->input('idDoctor');
		$commSubmitToBase->save();
		$this->setStateError(2);
		
		$array_comments = $this->getComments($id_doctor);
		$array_create = $this->getCreate_at($id_doctor);
		$array_namePatient = $this->getNamesPatient($id_doctor);
		
		if(count($array_comments) >= 1)
		{
			$array_comments = array_reverse($array_comments);
			$array_create = array_reverse($array_create);
			$array_namePatient = array_reverse($array_namePatient);
		}
		
		return view('login.comment', ['idDoctor' => $id_doctor, 'idPatient' => $id_patient, 'namePatient' => $name_patient, 'array_comment' => $array_comments, 'array_create' => $array_create, 'arrayNamePatient' => $array_namePatient, 'error' => $this->getStateError()]);
	}
}
