<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comment;

class MentionController extends Controller
{
	public function getArrayMentions()
	{
		$array_mentions = null;
		foreach(Comment::all() as $current)
		{
			$array_mentions[] = $current->content;
		}
		return $array_mentions;
	}
	public function getArrayDates()
	{
		$array_dates = null;
		foreach(Comment::all() as $current)
		{
			$array_dates[] = $current->updated_at;
		}
		return $array_dates;
	}
   public function getArrayNamePatient()
	{
		$array_names = null;
		foreach(Comment::all() as $current)
		{
			$array_names[] = $current->name_pacient;
		}
		return $array_names;
	}
    public function create()
	{
//		dd($this->getArrayNamePatient());
		return view('login/mentions', ['mentions' => $this->getArrayMentions(), 'dates' => $this->getArrayDates(), 'names' => $this->getArrayNamePatient()]);
	}
}
