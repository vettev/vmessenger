<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Auth;
use App\User;
use App\Message;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
    public function pusherAuth(Request $request)
    {
        if(Auth::user())
        {
            $pusher = App::make('pusher');
            $channelName = $request->channel_name;
            $socketId = $request->socket_id;
            
            return $pusher->socket_auth($channelName, $socketId);
        }
    }

    public function search(Request $request)
    {
        if(!$request->condition)
            return null;
        $condition = $request->condition;
        $users = User::where('name', 'like', '%'.$condition.'%')->get();
        if(!count($users))
            return null;

        return view('search-results', ['users' => $users]);
    }

    public function openConversation($id)
    {
        $user = User::find($id);
        $messages = Message::where([
            'recipient_id' => $id,
            'sender_id' => Auth::user()->id,
            ])
        ->orWhere([
            'recipient_id' => Auth::user()->id,
            'sender_id' => $id,
            ])
        ->orderBy('created_at', 'desc')
        ->limit(50)
        ->get()->reverse();

        return view('layouts.msg-window', ['user' => $user, 'messages' => $messages]);
    }
}
