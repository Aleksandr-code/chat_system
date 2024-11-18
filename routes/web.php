<?php

use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Message\MessageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserProfileConroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/chat', [ChatController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::post('/chat', [ChatController::class, 'store']);
    //сообщения посмотреть может только тот кто состоит в этом чате
    Route::get('/chat/{chat}', [ChatController::class, 'show']);
    //удалить может только тот кому чат принаджедит
    Route::delete('/chat/{chat}', [ChatController::class, 'destroy']);

    Route::post('/chat/sign', [ChatController::class, 'signInChat']);
    Route::post('/dashboard/chat/exit', [ChatController::class, 'logOutChat']);

    Route::get('/dashboard/user/chats', [UserProfileConroller::class, 'getChats']);
    //добавить сообщение можно только в тот чат в котором состоишь
    Route::post('/chat/{chat}/message', [MessageController::class, 'store']);
});

Route::prefix('/auth')->group(function(){
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::post('/login', [LoginUserController::class, 'store']);
    Route::post('/logout', [LoginUserController::class, 'destroy'])->middleware('auth');
});

Route::get('{page}', function () {
    return view('index');
})->where('page', '.*');

