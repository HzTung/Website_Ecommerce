<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Rooms;
use App\Models\Messages;
use App\Models\Employees;
use App\Events\MessageSent;
use App\Models\RoomMembers;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public $message_model;

    public function __construct()
    {
        $this->message_model = new Messages();
    }

    public function index()
    {
        $users = Employees::all();
        $id_user = Auth::guard('admin')->user()->id;

        $usersCollection = collect($users);
        $filteredUsers = $usersCollection->reject(function ($user) use ($id_user) {
            return $user['id'] == $id_user;
        });
        return view('admin.chats.index', [
            'name' => 'Chat',
            'key' => 'Home',
            'path' => '#',
            'users' => $filteredUsers,
        ]);
    }

    public function chatPrivate($user_id = '')
    {
        $users = Employees::all();
        $id_user = Auth::guard('admin')->user()->id;
        $usersCollection = collect($users);
        $filteredUsers = $usersCollection->reject(function ($user) use ($id_user) {
            return $user['id'] == $id_user;
        });

        $name_room = $this->createChannelName($id_user, $user_id);
        $user = Employees::where('id', $user_id)->first();
        $msg = $this->message_model->getMessage($name_room);

        $allMsg = DB::table('messages')
            ->join('rooms', "messages.room_id", "=", "rooms.id")
            ->get();
        return view('admin.chats.index', [
            'name' => 'Chat',
            'key' => 'Home',
            'path' => '#',
            'listUsers' => $filteredUsers,
            'user' => $user,
            'messages' => $msg,
            'allMsg' => $allMsg
        ]);
    }

    // public function greetReceiver(Request $request, Employees $receiver)
    // {
    //     broadcast(new MessageSent($receiver, "{$request->user()->name}"));
    //     // return back();
    // }
    function createChannelName($userId1, $userId2)
    {
        $ids = [$userId1, $userId2];
        sort($ids);
        return implode("-", $ids);
    }

    public function sendMessage(Request $request, $recipientId)
    {
        // $message = new Messages();
        // $message->content = $request->message;
        // $message->from_user_id = auth()->id();
        // $message->to_user_id = $recipientId;
        // $message->save();

        $channelName = $this->createChannelName(auth('admin')->id(), $recipientId);
        $message = $request->input('message');

        $room = Rooms::firstOrCreate(['room_name' => $channelName]);

        if ($room) {
            Messages::create([
                'user_id' => auth('admin')->id(),
                'room_id' => $room->id,
                'message_text' => $message,
                'sent_at' => now(),
            ]);
        }

        event(new MessageSent($message, $channelName, auth('admin')->id()));
        return back();
    }
}
