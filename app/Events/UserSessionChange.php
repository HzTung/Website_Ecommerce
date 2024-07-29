<?php

namespace App\Events;

use App\Models\Employees;
use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserSessionChange implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $message;
    public $type;
    public $user_id;

    public function __construct($user_id, $message, $type)
    {
        $this->user_id = $user_id;
        $this->message = $message;
        $this->type = $type;
    }

    public function broadcastOn()
    {
        // Log::debug("{$this->message} , {$this->type}");
        return new Channel('notifications');
    }
}
