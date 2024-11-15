<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
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

        $chats = $user->chats()->latest()->get();

        return response()->json(ChatResource::collection($chats), Response::HTTP_OK);

    }
}
