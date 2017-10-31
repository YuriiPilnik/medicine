<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Write extends Model
{
	public function requestDatesFromDB($idDoctor){
		$dates[] = null;
		foreach(Write::where('id_doctor', $idDoctor)->cursor() as $current)
			$dates[] = $current->date;
		return $dates;
	}
	public function insertIntoTable($idDoctor, $idPatient, $date, $description, $problem, $name_patient){
		DB::table('writes')->insert([
    		['id_doctor' => $idDoctor, 
    		'id_patients' => $idPatient,
    		'date' => $date,
    		'description' => $description,
    		'type' => $problem,
    		'namePatient' => $name_patient]
		]);		
	}
	public function getWrites($date, $id){
		return Write::orderBy('date', "ASC")->where('date', '>', $date)->where('id_patients', $id)->where("conclusion_state", 0)->get();	
	}
	public function getWritesForDoctor($idDoctor, $date){
		return Write::orderBy('date', "ASC")->where('date', '>', $date)->where("id_doctor", $idDoctor)->where("conclusion_state", 0)->get();
	} 
	public function updateTable($idWrite, $note, $diagnoz){
		return Write::where('id', $idWrite)->update(array('conclusion' => $diagnoz, 'conclusion_state' => 1, 'note' => $note));
	}
	public function getHistoryDisease($id_patient){
		return Write::orderBy('date', "ASC")->where('id_patients', $id_patient)->get();
	}
}
