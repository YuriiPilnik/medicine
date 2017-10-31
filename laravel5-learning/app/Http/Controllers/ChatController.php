<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Events\NewMessageAdded;

class ChatController extends Controller
{
    public function index()
	{
		$message = Message::all(); 
		return view('chat.index',['message' => $message]);
	}
	public function postMessage(Request $request)
	{
		$message = Message::create($request->all());
		event(new NewMessageAdded($message));
		return redirect()->back();
	}
}
