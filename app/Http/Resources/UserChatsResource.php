<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserChatsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
            'created_at' => $this->created_at->format('Y-m-d H:i'),
            'user_name' => User::find($this->user_id)->name,
            'users_count' => $this->users->count(),
            'user_time_sign' => $this->pivot->time_sign,
        ];
    }
}
