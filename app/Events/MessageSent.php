<?php

namespace App\Events;

use App\Models\Employees;
use App\Models\Messages;
use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $channel;
    public $message;
    public $user_id;
    public function __construct($message, $channel, $user_id)
    {
        $this->channel = $channel;
        $this->message = $message;
        $this->user_id = $user_id;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // Log::debug("{$this->message} ,{$this->channel} ");

        return new Channel(('chat.' . $this->channel));
    }
}
