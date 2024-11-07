<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MessageController extends Controller
{
    public function store(Request $request){

        $data = $request->validate([
            'chat_id' => 'required|integer|exists:chats,id',
            'user_id' => 'required|integer|exists:users,id',
            'content' => 'required|string'
        ]);

        $message = Message::create($data);

        return response($message, Response::HTTP_CREATED);
    }


}
