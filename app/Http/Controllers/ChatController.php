<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Events\Notify;
use App\Events\RepMess;
use Illuminate\Support\Facades\View;

class ChatController extends Controller
{
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function index()
    {
        $messages = Message::all();

        return view('chat', compact('messages'));
    }
    public function store(Request $request)
    {
        $message = new Message();
        $message->user_id = $request->input('user_id');
        $message->message = $request->input('message');
        $message->save();
        $user = $message->user;
        $rep_mess = $this->message->rep($message);
        event(new Notify($message, $user));
        event(new RepMess($rep_mess));
        $messages = Message::all();
        $returnHTML = \view('chat', compact('messages'))->renderSections()['content'];

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
}
