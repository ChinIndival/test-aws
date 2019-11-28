<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function rep($message)
    {
        $rep_message = new Message();
        $rep_message->user_id = 3;
        $mess1 = 'Please choose!';
                
        switch ($message->message)
        {
            case 'test':
                $rep_message->message = 'Im Chatbot';
                break;
            case 'chatbot':
                $rep_message->message = "Hi!";
                break;
            case 'what time is it?':
                $rep_message->message = Carbon::now()->format('H:m:s');
                break;
            case 'bye':
                $rep_message->message = 'Bye! See you again!';
                break;
            default:
                $rep_message->message = 'Type message again please!';
        }

        $rep_message->save();

        return $rep_message;
    }
}
