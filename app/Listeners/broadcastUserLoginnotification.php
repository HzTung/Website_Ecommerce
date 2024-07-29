<?php

namespace App\Listeners;

use App\Models\Employees;
use App\Events\UserSessionChange;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class broadcastUserLoginnotification
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
    public function handle(Login $event)
    {
        broadcast(new UserSessionChange("{$event->user->id}", " online", "success"));
        Employees::where('id', $event->user->id)->update(['status' => 'online']);
    }
}
