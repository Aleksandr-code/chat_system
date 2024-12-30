<?php


namespace App\Services;


use App\Models\Chat;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class ChatService
{
    public function createChat(int $userId, array $data):Chat
    {
        if(isset($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }

        $data['user_id'] = $userId;

        $chat = Chat::create($data);

        $this->attachUserInChatWithTimestamps($chat, $userId);

        return $chat;
    }

    public function joinUserInChat(int $userId, array $data):JsonResponse
    {
        $chatId = $data['chatId'];

        $chat = $this->getChatIfExist($chatId);

        $chatType = $chat->type;
        $inputPassword = $data['password'];
        $passwordFromChat = $chat->password;
        $this->confirmPasswordOnlyPrivateChat($chatType, $inputPassword, $passwordFromChat);

        $this->attachUserInChatWithTimestamps($chat, $userId);
    }

    private function confirmPasswordOnlyPrivateChat(string $chatType, string $inputPassword, string $passwordFromChat):JsonResponse
    {
        if($chatType === Chat::IS_PRIVATE){
            if(!Hash::check($inputPassword, $passwordFromChat)){
                return response()->json(['message'=> 'Chat id: {$chatId}, {$password} incorrect'], Response::HTTP_UNAUTHORIZED);
            }
        }
    }

    private function attachUserInChatWithTimestamps(Chat $chat, int $userId):void
    {
        $time_sign = Carbon::now()->toDateTimeString();

        $chat->users()->attach($userId, ['time_sign' => $time_sign]);
    }

    public function deleteAllUsersFromChat(Chat $chat):void
    {
        $chat->users()->detach();
    }

    public function deleteOneUserFromChat(int $chatId, int $userId):void
    {
        $chat = $this->getChatIfExist($chatId);

        $chat->users()->detach($userId);
    }

    private function getChatIfExist(int $chatId):Chat|JsonResponse
    {
        $chat = Chat::find($chatId);

        if ($chat === null) {
            return response()->json(['message'=> 'Chat with id {$chatId} not found'], Response::HTTP_NOT_FOUND);
        }

        return $chat;
    }
}
