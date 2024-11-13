<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserProfileConroller extends Controller
{
    public function update(){
        //
    }

    public function getChats(): Response
    {
        $user = auth()->user();

        $chats = $user->chats()->get();

        return response($chats, Response::HTTP_OK);

    }
}
