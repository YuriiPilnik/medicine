<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\write;
use App\Doctor;
class EntryPatientController extends Controller
{
	private $anwerRequest;
	public function setAnswerRequest($answer)
	{
		$this->anwerRequest = $answer;
	}
	public function getAnswerRequest()
	{
		return $this->anwerRequest;
	}
	public function getArrayDates()
	{
		$time[] = " 09:00:00";
		$time[] = " 10:00:00";
		$time[] = " 11:00:00";
		$time[] = " 12:00:00";
		$time[] = " 13:00:00";
		$time[] = " 15:00:00";
		$time[] = " 16:00:00";
		$time[] = " 17:00:00";
		$dayStep1 = 86400;
		$dayStep = 86400;
		for($i = 0; $i < 14; $i++)
		{
			$date[] = date('Y-m-d',time() + $dayStep);
			for($d = 0; $d < count($time); $d++)
			{
				$datetime[] = $date[$i] .$time[$d];
			}
			$dayStep+=$dayStep1;
		}
		return $datetime;
	}
	public function requestDatesFromDB($idDoctor)
	{
		$array_dates_entry[] = null;
		$doctor_dates_entry = Write::where('id_doctor', $idDoctor)->get();	
		foreach ($doctor_dates_entry as $current)
		{	
		 	$array_dates_entry[] = $current->dates;
		}
		return $array_dates_entry;
	}
	public function getResultArrayDates($array_busy_dates, $res)
	{
		foreach($array_busy_dates as $busy)
		{
			foreach($res as $result)
			{
				if($busy == $result)
				{
					$res = array_diff($res, array($result));
					$res = array_values($res);
				}
			}
		}
		return $res;
	}
    public function create(Request $request)
	{	
		$idDoctor = $request->input('idDoctor');
		$array_busy_dates = $this->requestDatesFromDB($idDoctor);
		$res = $this->getArrayDates();
		$resDates = $this->getResultArrayDates($array_busy_dates, $res);
		$this->setAnswerRequest(0);
		return view('login.entryConsultation', ['dates' => $resDates, 'idDoctor' => $request->input('idDoctor'), 'namePatient' => $request->input('namePatient'),  'answer' => $this->getAnswerRequest(), 'id_patient' => $request->input('id_patient')]);
	}
	public function store(Request $request)
	{
		$entrys = new write;
		$res = $this->getArrayDates();
		$name_patient = $request->input('name_patient');
		$date = $request->input('date');
		$type = $request->input('type_problem');
		$id_doctor = $request->input('id_doctor');
		$id_patient = $request->input('id_patient');
		$description = $request->input('description');
		
		if($type == '' || $description == '')
		{
			$array_busy_dates = $this->requestDatesFromDB($id_doctor);
			$resDates = $this->getResultArrayDates($array_busy_dates, $res);
			$this->setAnswerRequest(1);
			return view('login.entryConsultation', ['namePatient' => $name_patient, 'dates' => $resDates, 'type' => $type, 'idDoctor' => $id_doctor, 'answer' => $this->getAnswerRequest(), 'id_patient' => $id_patient]);	
		}
		$this->setAnswerRequest(2);
		$entrys->dates = $date;
		$entrys->description = $description;
		$entrys->type = $type;
		$entrys->name_pacient = $name_patient;
		$entrys->id_doctor = $id_doctor;
		$entrys->id_patients = $id_patient;
		try{
			$result = $entrys->save();		
		}catch(\Illuminate\Database\QueryException $e){
			
		}
		$array_busy_dates = $this->requestDatesFromDB($id_doctor);
		$resDates = $this->getResultArrayDates($array_busy_dates, $res);
		return view('login.entryConsultation', ['namePatient' => $name_patient, 'dates' => $resDates, 'type' => $type, 'idDoctor' => $id_doctor, 'answer' => $this->getAnswerRequest(), 'id_patient' => $id_patient]);
	}
}
