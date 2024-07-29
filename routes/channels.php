<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('notifications', function () {
    return true;
});

// Broadcast::channel('chat.private.{receiver_id}', function ($user, $receiver_id) {
//     return (int) $user->id === (int) $receiver_id;
// });

Broadcast::channel('chat.{id1}-{id2}', function ($user, $id1, $id2) {
    // if ((int) $user->id == (int) $id1 || (int) $user->id == (int) $id2) {
    //     return true;
    // } else {
    //     return false;
    // }

    return true;
});

// Broadcast::channel('chat.{id1}-{id2}', function ($user, $id1, $id2) {
//     // if ((int) $user->id == (int) $id1 || (int) $user->id == (int) $id2) {
//     //     return true;
//     // } else {
//     //     return false;
//     // }

//     return true;
// }, ['guards' => ['admin']]);
