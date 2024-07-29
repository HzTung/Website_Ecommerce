<?php

namespace App\Listeners;

use App\Models\Employees;
use App\Events\UserOnlineStatus;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateUserOnlineStatus
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
     * @param  \App\Events\UserOnlineStatus  $event
     * @return void
     */
    public function handle(UserOnlineStatus $event)
    {
        Employees::where('id', $event->user->id)->update([
            'status' => $event->status,
        ]);
    }
}
