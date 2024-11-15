<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChatStoreRequest;
use App\Http\Resources\ChatResource;
use App\Http\Resources\MessageResource;
use App\Models\Chat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class ChatController extends Controller
{
    public function index(): JsonResponse
    {
        $chats = Chat::latest()->get();

        return response()->json(ChatResource::collection($chats), Response::HTTP_CREATED);
    }

    public function store(ChatStoreRequest $request){
        //validate request
        $data = $request->validated();
        //hash password
        if(isset($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }
        //create chat
        $chat = Chat::create($data);
        //sign in chat
        $chat->users()->attach($chat->user_id);
        //return
        return response($chat, Response::HTTP_CREATED);
    }

    public function show(Chat $chat): JsonResponse
    {
        //all messages in the chat
        $chatMessages = $chat->messages()->get();
        // return
        return response()->json(MessageResource::collection($chatMessages), Response::HTTP_OK);
    }

    public function destroy(Chat $chat){
        //logout all users
        $chat->users()->detach();
        //delete chat
        $chat->delete();

        return response([], Response::HTTP_OK);
    }

    public function signInChat($chatId, $userId, $password){
        //find a chat
        $chat = Chat::find($chatId);
        //check found
        if ($chat === null) {
            return response(['message'=> 'Chat with id {$chatId} not found'], Response::HTTP_NOT_FOUND);
        }
        //Check Type and Password
        if($chat->type === Chat::IS_PRIVATE){
            if($chat->password !== $password){
                return response(['message'=> 'Chat id: {$chatId}, {$password} incorrect'], Response::HTTP_UNAUTHORIZED);
            }
        }
        //Sign in Chat
        $chat->users()->attach($userId);
    }

    public function logOutChat($chatId, $userId){
        //findOrFailChat
        $chat = Chat::find($chatId);
        //Logout Chat
        $chat->users()->detach($userId);
    }

}
