<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;

class DoctorStateController extends Controller
{
	public function changeWorkingState($id, $workState)
	{
		Doctor::where('id', $id)->update(['workingState' => $workState]);
	}
    public function create(Request $request)
	{
		$id = $request->input('idDoctor');
		$workState = $request->input('workState');
		$this->changeWorkingState($id, $workState);
		return view('login.doctorWeekend', ['workState' => $workState]);
	}
}
