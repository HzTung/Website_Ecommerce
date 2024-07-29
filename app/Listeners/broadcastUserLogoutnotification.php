<?php

namespace App\Listeners;

use App\Events\UserSessionChange;
use App\Models\Employees;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class broadcastUserLogoutnotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        broadcast(new UserSessionChange("{$event->user->id}", "offline", "muted"));
        Employees::where('id', $event->user->id)->update(['status' => 'offline']);
    }
}
