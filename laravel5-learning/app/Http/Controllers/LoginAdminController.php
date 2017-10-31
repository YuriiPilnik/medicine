<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\admin;
use App\patient;
use App\comment;
use App\Doctor;
use App\Models\Home;

class LoginAdminController extends Controller
{
//	methods and fields for creating content admin room 
	private $answer;
	public function setAnswer($answer)
	{
		$this->answer = $answer;
	}
	public function getAnswer()
	{
		return $this->answer;
	}
	public function getArrrayComments()
	{
		$array_comments = null;
		foreach(Comment::all() as $current)
		{
			$array_comments[] = $current->content; 
		}
		return $array_comments;
	}
	public function getArrayDates()
	{
		$array_dates = null;
		foreach(Comment::all() as $current)
		{
			$array_dates[] = $current->created_at;
		}
		return $array_dates;
	}
	public function getArrayNames()
	{
		$array_names = null;
		foreach(Comment::all() as $current)
		{
			$array_names[] = $current->name_pacient;
		}
		return $array_names;
	}
	public function getArrayIds()
	{
		$array_ids = null;
		foreach(Comment::all() as $current)
		{
			$array_ids[] = $current->id_patient;
		}
		return $array_ids;
	}
	public function getArray_access_comment($array_ids)
	{
		$array_access_comment = null;
		for($i = 0; $i < count($array_ids); $i++)
		{
			foreach(Patient::where('id', $array_ids[$i])->cursor() as $current)
			{
				$array_access_comment[] = $current->access_comment;
			}
		}
		return $array_access_comment;
	}
	public function getArrayIdComment()
	{
		$ids = null;
		foreach(Comment::all() as $current)
		{
			$ids[] = $current->id;
		}
		return $ids;
	}
	public function getAccessCabinet($login, $password)
	{
		$resfind = false;
		foreach (Admin::where('login', $login)->where('passwd', $password)->cursor() as $login) 
		{
			$resfind = true;
		}
		return $resfind;
	}
    public function getAdminId($login, $password)
	{
		foreach (Admin::where('login', $login)->where('passwd', $password)->cursor() as $current) 
		{
			$Id = $current->id;
		}
		return $Id;
	}
    public function create()
	{
		$this->setAnswer(0);
		return view('login.signinAdmin', ['answer' => $this->getAnswer()]);
	}
	public function store(Request $request)
	{
		if($request->input('login3') == '' || $request->input('passwd3') == '')
		{
			$this->setAnswer(1);
			return view('login.signinAdmin', ['answer' => $this->getAnswer()]);	
		}
		$res = $this->getAccessCabinet($request->input('login3'), $request->input('passwd3'));
		if($res == false)
		{
			$this->setAnswer(2);
			return view('login.signinAdmin', ['answer' => $this->getAnswer()]);
		}
		else if($res == true)
		{
			$array_comments = $this->getArrrayComments();
			$array_dates = $this->getArrayDates();
			$array_names = $this->getArrayNames();
			$array_ids = $this->getArrayIds();
			$ids = $this->getArrayIdComment();
			$array_access_comment = $this->getArray_access_comment($array_ids);			
			$resId = $this->getAdminId($request->input('login3'), $request->input('passwd3'));
			return view('login.roomAdmini', ['idAdmin' => $resId, 'answer' => 0, 'array_comments' => $array_comments, 'array_dates' => $array_dates, 'array_names' => $array_names, 'array_ids' => $array_ids, 'ids' => $ids, 'login3' => $request->input('login3') , 'passwd3' => $request->input('passwd3'), 'access_commentary' => $array_access_comment]);
		}
		return view('login.signinAdmin');
	}
	
//	methods for deleteing comments
	
	public function deleteFromTableCommets($id_comment)
	{
		Comment::where('id', $id_comment)->delete();
	}
	public function delete(Request $request)
	{
		$this->deleteFromTableCommets($request->input('id_comment'));
		$array_comments = $this->getArrrayComments();
		$array_dates = $this->getArrayDates();
		$array_names = $this->getArrayNames();
		$array_ids = $this->getArrayIds();
		$ids = $this->getArrayIdComment();
		$resId = $this->getAdminId($request->input('login3'), $request->input('passwd3'));
		$array_access_comment = $this->getArray_access_comment($array_ids);		
		return view('login.roomAdmini', ['idAdmin' => $resId, 'answer' => 0, 'array_comments' => $array_comments, 'array_dates' => $array_dates, 'array_names' => $array_names, 'array_ids' => $array_ids, 'ids' => $ids, 'login3' => $request->input('login3') , 'passwd3' => $request->input('passwd3'), 'access_commentary' => $array_access_comment]);	
	}
//	methods for blocking patient
	
	public function setDisableEditComments($id_patient)
	{
		Patient::where('id', $id_patient)->update(['access_comment' => 0]);
	}
	public function setEnableEditComments($id_patient)
	{
		Patient::where('id', $id_patient)->update(['access_comment' => 1]);
	}
	public function blockingPatient(Request $request)
	{
		if($request->input('stateEditable') == 1)
		{
			$this->setDisableEditComments($request->input('id_patient'));		
		}
		else if($request->input('stateEditable') == 0)
		{
			$this->setEnableEditComments($request->input('id_patient'));
		}
		$array_comments = $this->getArrrayComments();
		$array_dates = $this->getArrayDates();
		$array_names = $this->getArrayNames();
		$array_ids = $this->getArrayIds();
		$ids = $this->getArrayIdComment();
		$array_access_comment = $this->getArray_access_comment($array_ids);			
		$resId = $this->getAdminId($request->input('login3'), $request->input('passwd3'));
		return view('login.roomAdmini', ['idAdmin' => $resId, 'answer' => 0, 'array_comments' => $array_comments, 'array_dates' => $array_dates, 'array_names' => $array_names, 'array_ids' => $array_ids, 'ids' => $ids, 'login3' => $request->input('login3') , 'passwd3' => $request->input('passwd3'), 'access_commentary' => $array_access_comment]);	
	}
//	store and delete Doctors
	private $answerAditionDoctor;
	private $answerDeleteDoctor;
	public function setAnswerForDoctor($addDocAnswer)
	{
		$this->answerAditionDoctor = $addDocAnswer;
	}
	public function getAnswerForDoctor()
	{
		return $this->answerAditionDoctor;
	}
	public function setAnswerDelDoctor($answerDeleteDoctor)
	{
		$this->answerDeleteDoctor = $answerDeleteDoctor;
	}
	public function getAnswerDelDoctor()
	{
		return $this->answerDeleteDoctor;
	}
	public function isLogin($login)
	{
		$resfind = false;
		foreach(Doctor::where('login', $login)->cursor() as $current)
		{
			$resfind = true;
		}
		return $resfind;
	}
    public function isEmail($email)
	{
		$resfind = false;
		foreach(Doctor::where('email', $email)->cursor() as $current)
		{
			$resfind = true;
		}
		return $resfind;
	}
	public function deleteFromTableDoctor($login)
	{
		Doctor::where('login', $login)->delete();
	}
	public function storeDoctor(Request $request)
	{	
		$array_comments = $this->getArrrayComments();
		$array_dates = $this->getArrayDates();
		$array_names = $this->getArrayNames();
		$array_ids = $this->getArrayIds();
		$ids = $this->getArrayIdComment();	
		$array_access_comment = $this->getArray_access_comment($array_ids);			
		$resId = $this->getAdminId($request->input('login3'), $request->input('passwd3'));
		if($request->input('action') == "addDoctor")
		{
			if($request->input('name') == '' || $request->input('login') == '' || $request->input('password1') == '' || $request->input('password2') == '' || $request->input('standing') == '' || $request->input('specialyty') == '' ||  $request->input('description') == '' )
			{
				$this->setAnswerForDoctor(1);
				return view('login.roomAdmini', ['idAdmin' => $request->input('idAdmin'), 'answer' => $this->getAnswerForDoctor(), 'array_comments' => $array_comments, 'array_dates' => $array_dates, 'array_names' => $array_names, 'array_ids' => $array_ids, 'ids' => $ids, 'login3' => $request->input('login3') , 'passwd3' => $request->input('passwd3'), 'access_commentary' => $array_access_comment]);	
			}
			else if($request->input('password1') !== $request->input('password2'))
			{	
				$this->setAnswerForDoctor(2);
				return view('login.roomAdmini', ['idAdmin' => $request->input('idAdmin'), 'answer' => $this->getAnswerForDoctor(), 'array_comments' => $array_comments, 'array_dates' => $array_dates, 'array_names' => $array_names, 'array_ids' => $array_ids, 'ids' => $ids, 'login3' => $request->input('login3') , 'passwd3' => $request->input('passwd3'), 'access_commentary' => $array_access_comment]);		
			}
			else if($this->isEmail($request->input('email')) || $this->isLogin($request->input('login')))
			{
				$this->setAnswerForDoctor(4);
				return view('login.roomAdmini', ['idAdmin' => $request->input('idAdmin'), 'answer' => $this->getAnswerForDoctor(), 'array_comments' => $array_comments, 'array_dates' => $array_dates, 'array_names' => $array_names, 'array_ids' => $array_ids, 'ids' => $ids, 'login3' => $request->input('login3') , 'passwd3' => $request->input('passwd3'), 'access_commentary' => $array_access_comment]);		
			}
			$doctor = new doctor;
			$doctor->fio = $request->input('name');
			$doctor->login = $request->input('login');
			$doctor->passwd = $request->input('password1');
			$doctor->description = $request->input('description');
			$doctor->id_admin = $request->input('idAdmin');
			$doctor->standing = $request->input('standing');
			$doctor->login = $request->input('login');
			$doctor->email = $request->input('email');
			$doctor->workingState = $request->input('workingState');
			$doctor->specialty = $request->input('specialyty');
			$doctor->save();
			$this->setAnswerForDoctor(3);
			return view('login.roomAdmini', ['idAdmin' => $request->input('idAdmin'), 'answer' => $this->getAnswerForDoctor(), 'array_comments' => $array_comments, 'array_dates' => $array_dates, 'array_names' => $array_names, 'array_ids' => $array_ids, 'ids' => $ids, 'login3' => $request->input('login3') , 'passwd3' => $request->input('passwd3'), 'access_commentary' => $array_access_comment]);	
		}
		else if($request->input('action') == "delDoctor")
		{
			if($request->input('login1') == '' || $request->input('login2') == '')
			{	
				$this->setAnswerDelDoctor(5);
				return view('login.roomAdmini', ['idAdmin' => $request->input('idAdmin'), 'answer' => $this->getAnswerDelDoctor(), 'array_comments' => $array_comments, 'array_dates' => $array_dates, 'array_names' => $array_names, 'array_ids' => $array_ids, 'ids' => $ids, 'login3' => $request->input('login3') , 'passwd3' => $request->input('passwd3'), 'access_commentary' => $array_access_comment]);	
			}
			else if($request->input('login1') !== $request->input('login2'))
			{
				$this->setAnswerDelDoctor(6);
				return view('login.roomAdmini', ['idAdmin' => $request->input('idAdmin'), 'answer' => $this->getAnswerDelDoctor(), 'array_comments' => $array_comments, 'array_dates' => $array_dates, 'array_names' => $array_names, 'array_ids' => $array_ids, 'ids' => $ids, 'login3' => $request->input('login3') , 'passwd3' => $request->input('passwd3'), 'access_commentary' => $array_access_comment]);
			}
			else if(!$this->isLogin($request->input('login1')))
			{
				$this->setAnswerDelDoctor(7);
				return view('login.roomAdmini', ['idAdmin' => $request->input('idAdmin'), 'answer' => $this->getAnswerDelDoctor(), 'array_comments' => $array_comments, 'array_dates' => $array_dates, 'array_names' => $array_names, 'array_ids' => $array_ids, 'ids' => $ids, 'login3' => $request->input('login3') , 'passwd3' => $request->input('passwd3'), 'access_commentary' => $array_access_comment]);
			}
			$this->setAnswerDelDoctor(8);
			$this->deleteFromTableDoctor($request->input('login1'));
			return view('login.roomAdmini', ['idAdmin' => $request->input('idAdmin'), 'answer' => $this->getAnswerDelDoctor(), 'array_comments' => $array_comments, 'array_dates' => $array_dates, 'array_names' => $array_names, 'array_ids' => $array_ids, 'ids' => $ids, 'login3' => $request->input('login3') , 'passwd3' => $request->input('passwd3'), 'access_commentary' => $array_access_comment]);					
		}
	}
	// news publish
	private $newsState;
	public function setNewsState($newsState)
	{
		$this->newsState = $newsState;
	}
	public function getNewsState()
	{
		return $this->newsState;
	}
	public function publishNews($content, $title, $IdAdmin)
	{
		$news = new home;
		$news->title = $title;
		$news->content = $content;
		$news->published = 1;
		$news->id_admin= $IdAdmin;
		$news->save();
	}
	public function publishHomeNews(Request $request)
	{
		$array_comments = $this->getArrrayComments();
		$array_dates = $this->getArrayDates();
		$array_names = $this->getArrayNames();
		$array_ids = $this->getArrayIds();
		$ids = $this->getArrayIdComment();	
		$array_access_comment = $this->getArray_access_comment($array_ids);			
		$resId = $this->getAdminId($request->input('login3'), $request->input('passwd3'));
		
		if($request->input('contentNews') == '' || $request->input('title') == '')
		{
			$this->setNewsState(9);
			return view('login.roomAdmini', ['idAdmin' => $request->input('idAdmin'), 'answer' => $this->getNewsState(), 'array_comments' => $array_comments, 'array_dates' => $array_dates, 'array_names' => $array_names, 'array_ids' => $array_ids, 'ids' => $ids, 'login3' => $request->input('login3') , 'passwd3' => $request->input('passwd3'), 'access_commentary' => $array_access_comment]);
		}
		$this->setNewsState(10);
		$this->publishNews($request->input('contentNews'), $request->input('title'), $resId);
		return view('login.roomAdmini', ['idAdmin' => $request->input('idAdmin'), 'answer' => $this->getNewsState(), 'array_comments' => $array_comments, 'array_dates' => $array_dates, 'array_names' => $array_names, 'array_ids' => $array_ids, 'ids' => $ids, 'login3' => $request->input('login3') , 'passwd3' => $request->input('passwd3'), 'access_commentary' => $array_access_comment]);
	}
	
	// news Deleting
	
	public function delNews($title, $date)
	{
		$resDel = Home::where('created_at', $date)->where('title', $title)->delete();
		return $resDel;
	}	
	public function DelHomeNews(Request $request)
	{
		$array_comments = $this->getArrrayComments();
		$array_dates = $this->getArrayDates();
		$array_names = $this->getArrayNames();
		$array_ids = $this->getArrayIds();
		$ids = $this->getArrayIdComment();	
		$array_access_comment = $this->getArray_access_comment($array_ids);			
		$resId = $this->getAdminId($request->input('login3'), $request->input('passwd3'));
		
		if($request->input('publishDate') == '' || $request->input('title') == '')
		{
			$this->setNewsState(11);
			return view('login.roomAdmini', ['idAdmin' => $request->input('idAdmin'), 'answer' => $this->getNewsState(), 'array_comments' => $array_comments, 'array_dates' => $array_dates, 'array_names' => $array_names, 'array_ids' => $array_ids, 'ids' => $ids, 'login3' => $request->input('login3') , 'passwd3' => $request->input('passwd3'), 'access_commentary' => $array_access_comment]);
		}
		$this->setNewsState(12);
		$resDel = $this->delNews($request->input('title'), $request->input('publishDate'));
		if($resDel == 1)
		{
			$this->setNewsState(12);	
		}
		else if($resDel == 0)
		{
			$this->setNewsState(13);	
		}
		return view('login.roomAdmini', ['idAdmin' => $request->input('idAdmin'), 'answer' => $this->getNewsState(), 'array_comments' => $array_comments, 'array_dates' => $array_dates, 'array_names' => $array_names, 'array_ids' => $array_ids, 'ids' => $ids, 'login3' => $request->input('login3') , 'passwd3' => $request->input('passwd3'), 'access_commentary' => $array_access_comment]);
	}
}
