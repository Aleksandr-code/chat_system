<?php

namespace App\Http\Controllers\Message;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageStoreRequest;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class MessageController extends Controller
{
    public function store(MessageStoreRequest $request, Chat $chat){

        Gate::authorize('store-message', $chat);

        $data = $request->validated();

        $data['user_id'] = $request->user()->id;
        $data['chat_id'] = $chat->id;

        $message = Message::create($data);

//        broadcast(new MessageSent($message))->toOthers();

        return response($message, Response::HTTP_CREATED);
    }


}
