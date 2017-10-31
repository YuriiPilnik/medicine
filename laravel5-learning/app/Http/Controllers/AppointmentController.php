<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\Write;
use App\Patient;
class AppointmentController extends Controller
{
    public function index(Doctor $doctor, Write $write){
    	$idPatient = $_COOKIE['cookieIdPatient'];
    	$historys = $write->getHistoryDisease($idPatient);
    	$date = date('Y-m-d H:i:s');
    	$name =  $_COOKIE['cookieIdPatient'];
    	$writes = $write->getWrites($date, $name);
    	$doctors = $doctor->getWorkingDoctors();
    	$array_specialtys = $doctor->getArraySpecialtyDoctor();
    	$array_specialtys_uniq = array_unique($array_specialtys);
		$array_specialtys_uniq = array_values($array_specialtys_uniq);
		return view("appintment", compact("doctors", "historys"), compact("array_specialtys_uniq", "writes"));
    }
    public function getArrayDates(){
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
		for($i = 0; $i < 14; $i++){
			$date[] = date('Y-m-d',time() + $dayStep);
			for($d = 0; $d < count($time); $d++)
			{
				$datetime[] = $date[$i] .$time[$d];
			}
			$dayStep+=$dayStep1;
		}
		return $datetime;
	}
	public function getResultArrayDates($array_busy_dates, $res){
		foreach($array_busy_dates as $busy){
			foreach($res as $result){
				if($busy == $result){
					$res = array_diff($res, array($result));
					$res = array_values($res);
				}
			}
		}
		return $res;
	}
    public function store(Request $request, Write $write){
    	$idDoctor = $request->input('id');
		setcookie("cookieIdForSubmit", $idDoctor, time()+3600*24*30);
		$array_busy_dates = $write->requestDatesFromDB($idDoctor);
		$res_free_dates = $this->getArrayDates();
		$resDates = $this->getResultArrayDates($array_busy_dates, $res_free_dates);
    	return $resDates;
    }
    public function submitWrite(Request $request, Write $write, Patient $patient){
    	$idDoctor = $_COOKIE['cookieIdForSubmit'];
    	$idPatient = $_COOKIE['cookieIdPatient'];
    	$name_patient = $patient->getNameById($idPatient);
    	$description = $request->input("desrciptionAppoinment");
    	$problem = $request->input("problem");
    	$date = $request->input("dateAppointment");
    	$write->insertIntoTable($idDoctor, $idPatient, $date, $description, $problem, $name_patient);
    	return json_encode(array("type" =>  $problem , "date" => $date, "description" => $description));
    }
}
