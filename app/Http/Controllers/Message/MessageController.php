<?php

namespace App\Http\Controllers\Message;

use App\Events\MessageSent;
use App\Events\MessageSubmitted;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageStoreRequest;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MessageController extends Controller
{
    public function store(MessageStoreRequest $request){

        $data = $request->validated();

        $message = Message::create($data);

//        broadcast(new MessageSent($message))->toOthers();

        return response($message, Response::HTTP_CREATED);
    }


}
