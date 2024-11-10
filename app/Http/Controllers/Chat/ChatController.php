<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class ChatController extends Controller
{
    public function index(){

        $chats = Chat::latest()->get();

        return response($chats, Response::HTTP_OK);
    }

    public function store(Request $request){
        //validate request
        $data = $request->validate([
            'title' => 'required|string',
            'user_id' => 'required|integer|exists:users,id',
            'type'=> 'required|string|max:10',
            'password' => 'string|nullable']);
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

    public function show(Chat $chat){
        //all messages in the chat
        $chatMessages = $chat->messages()->get();
        // return
        return response($chatMessages, Response::HTTP_OK);
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
            return response("Chat with id {$chatId} not found", Response::HTTP_NOT_FOUND);
        }
        //Check Type and Password
        if($chat->type === Chat::IS_PRIVATE){
            if($chat->password !== $password){
                return response("Chat id: {$chatId}, {$password} incorrect", Response::HTTP_UNAUTHORIZED);
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
