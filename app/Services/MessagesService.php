<?php

namespace App\Services;

use App\Models\Messages;

class MessagesService
{
    public function getMessage($name)
    {
        try {
            $result = Messages::select('messages.*')
                ->join('rooms', 'messages.room_id', '=', 'rooms.id')
                ->where('room_name', $name)
                ->get();
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $result;
    }
}
