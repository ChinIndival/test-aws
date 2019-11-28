<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\User;

class RepMess implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $rep_mess;

    public $time;

    public $user;


    public function __construct($rep_mess)
    {
        $this->rep_mess = $rep_mess->message;

        $this->user = User::where('id', 3)->first()->name;

        $this->time = $rep_mess->created_at->format('Y-m-d | H:m:s');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new \Illuminate\Broadcasting\Channel('rep_mess');
    }
}
