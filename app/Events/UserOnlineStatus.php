<?php

namespace App\Events;

use App\Models\Employees;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use BeyondCode\LaravelWebSockets\WebSockets\Channels\Channel;

class UserOnlineStatus
{
    use Dispatchable, SerializesModels;

    public $user;
    public $status;

    public function __construct(Employees $user, $status)
    {
        $this->user = $user;
        $this->status = $status;
    }

    public function broadcastOn()
    {
        return new  Channel('userStatus');
    }
}
