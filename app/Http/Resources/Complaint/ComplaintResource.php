<?php

namespace App\Http\Resources\Complaint;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'is_solved' => $this->is_solved,
            'user' => UserResource::make($this->user)->resolve(),
            'message_id' => $this->message_id,
            'theme_id' => $this->theme_id
        ];
    }
}
