<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChatStoreRequest;
use App\Http\Resources\ChatResource;
use App\Http\Resources\MessageResource;
use App\Models\Chat;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class ChatController extends Controller
{
    public function index(): JsonResponse
    {
        $chats = Chat::latest()->get();

        return response()->json(ChatResource::collection($chats), Response::HTTP_OK);
    }

    public function store(ChatStoreRequest $request){
        //validate request
        $data = $request->validated();
        //hash password
        if(isset($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }
        //add user, that created the chat
        $data['user_id'] = auth()->user()->id;
        //create chat
        $chat = Chat::create($data);
        //Add time sign
        $time_sign = Carbon::now()->toDateTimeString();
        //sign in chat
        $chat->users()->attach($chat->user_id, ['time_sign' => $time_sign]);
        //return
        return response($chat, Response::HTTP_CREATED);
    }

    public function show(Chat $chat): JsonResponse
    {
        //authorize to show
        $this->authorize('view', $chat);
        //all messages in the chat
        $chatMessages = $chat->messages()->get();
        // return
        return response()->json(MessageResource::collection($chatMessages), Response::HTTP_OK);
    }

    public function destroy(Chat $chat){
        //authorize to delete
        $this->authorize('delete', $chat);
        //logout all users
        $chat->users()->detach();
        //delete chat
        $chat->delete();

        return response([], Response::HTTP_OK);
    }

    public function signInChat(Request $request): JsonResponse
    {
        $data = $request->validate([
            'chatId' => 'required|integer',
            'password' => 'string|nullable'
        ]);
        //find a chat
        $chat = Chat::find($data['chatId']);
        //check found
        if ($chat === null) {
            return response()->json(['message'=> 'Chat with id {$chatId} not found'], Response::HTTP_NOT_FOUND);
        }
        //Check Type and Password
        if($chat->type === Chat::IS_PRIVATE){
            if(!Hash::check($data['password'], $chat->password)){
                return response()->json(['message'=> 'Chat id: {$chatId}, {$password} incorrect'], Response::HTTP_UNAUTHORIZED);
            }
        }
        //Add time sign
        $time_sign = Carbon::now()->toDateTimeString();
        //Sign in Chat
        $chat->users()->attach($request->user()->id, ['time_sign' => $time_sign]);

        return response()->json(['message'=> 'User connect succesfully'], Response::HTTP_OK);
    }

    public function logOutChat(Request $request):JsonResponse
    {
        $data = $request->validate([
            'chatId' => 'required|integer',
        ]);
        //findOrFailChat
        $chat = Chat::find($data['chatId']);
        //Logout Chat
        $chat->users()->detach($request->user()->id);

        return response()->json(['message'=> 'Exiting the chat - ok'], Response::HTTP_OK);
    }

}
