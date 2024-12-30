<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChatStoreRequest;
use App\Http\Resources\ChatResource;
use App\Http\Resources\MessageResource;
use App\Models\Chat;
use App\Services\ChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChatController extends Controller
{
    public function index(): JsonResponse
    {
        $chats = Chat::latest()->get();

        return response()->json(ChatResource::collection($chats), Response::HTTP_OK);
    }

    public function store(ChatStoreRequest $request, ChatService $chatService):JsonResponse
    {
        $data = $request->validated();

        $userId = auth()->user()->id;

        $chat = $chatService->createChat($userId, $data);

        return response()->json($chat, Response::HTTP_CREATED);
    }

    public function show(Chat $chat): JsonResponse
    {
        $this->authorize('view', $chat);

        $chatMessages = $chat->messages()->get();

        return response()->json(MessageResource::collection($chatMessages), Response::HTTP_OK);
    }

    public function destroy(Chat $chat, ChatService $chatService):JsonResponse
    {
        $this->authorize('delete', $chat);

        $chatService->deleteAllUsersFromChat($chat);

        $chat->delete();

        return response()->json([], Response::HTTP_OK);
    }

    public function signInChat(Request $request, ChatService $chatService): JsonResponse
    {
        $data = $request->validate([
            'chatId' => 'required|integer',
            'password' => 'string|nullable'
        ]);

        $userId = $request->user()->id;

        $chatService->joinUserInChat($userId, $data);

        return response()->json(['message'=> 'User connect succesfully'], Response::HTTP_OK);
    }

    public function logOutChat(Request $request, ChatService $chatService):JsonResponse
    {
        $data = $request->validate([
            'chatId' => 'required|integer',
        ]);

        $chatId = $data['chatId'];
        $userId = $request->user()->id;

        $chatService->deleteOneUserFromChat($chatId, $userId);

        return response()->json(['message'=> 'Exiting the chat - ok'], Response::HTTP_OK);
    }

}
