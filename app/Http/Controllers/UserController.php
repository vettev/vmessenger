<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\User;
use App\Contact;
use App\Message;
use Auth;

class UserController extends Controller
{
	private $pusher;

	public function __construct()
	{
		$this->pusher = App::make('pusher');
	}

	public function showContacts()
	{
		$contacts = Auth::user()->contacts;

		return view('user.contacts', ['contacts' => $contacts]);
	}

    public function addContact($id, Request $request)
    {
    	if($id === Auth::user()->id || count(Auth::user()->contacts->where('contact_id', $id)) > 0)
    		return null;

    	$contact = new Contact();
    	$contact->user_id = Auth::user()->id;
    	$contact->contact_id = $id;
    	$contact->save();

    	return "ok";
    }

    public function newMessage($id, Request $request)
    {
    	$sender = Auth::user();

    	$message = new Message();
    	$message->sender_id = $sender->id;
    	$message->recipient_id = $id;
    	$message->content = $request->message;
    	$message->save();

		$channel = "private-user-".$id;
		$data = ['content' => $message->content, 'sender_id' => $message->sender_id, 'created_at' => $message->created_at->diffForHumans(), 'sender' => $sender->name];
        $this->pusher->trigger($channel, 'message', $data);

    	return view('layouts.message', ['message' => $message]);
    }

    public function messages($id)
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
        ->get()->reverse();

        return view('layouts.messages', ['messages' => $messages]);
    }
}
