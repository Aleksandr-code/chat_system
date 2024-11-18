<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserChatsResource;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserProfileConroller extends Controller
{
    public function update(){
        //
    }

    public function getChats(): JsonResponse
    {
        $user = auth()->user();

        // возвращать по дате присоединения к чату
        $chats = $user->chats()->get();

        return response()->json(UserChatsResource::collection($chats), Response::HTTP_OK);

    }
}
