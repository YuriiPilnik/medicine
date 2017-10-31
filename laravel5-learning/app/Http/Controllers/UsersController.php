<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UsersController extends Controller
{
    public function index()
	{
		$users = [
			'0' => [
			'first_name' => 'Renato',
			'last_name' => 'Hysa',
			'location' => 'Albania'
		],
			'1' =>[
			'first_name' => 'Jessika',
			'last_name' => 'Alba',
			'location' => 'USA'
		]
		];
//		dd($users);
		return view('admin.users.index', compact('users'));
	}
	public function create()
	{
		return view('admin.users.create');
	}
	public function store(Request $request)
	{
//		dd($request->all());
		$name = $request->input('name');
		if($name == '')
		{
			return view('admin.users.create');
		}
		User::create($request->all());
		return $request->all(); 
	}
}
