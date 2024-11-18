<?php

namespace App\Http\Resources\Theme;

use App\Http\Resources\Message\MessageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ThemeWithMessagesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $msgIds = Auth::user()->likedMessages()->get()->pluck('id');

        $this->messages->each(function ($message) use ($msgIds) {
            $message->is_liked = $msgIds->contains($message->id);
        });

        $complaintedMsgs = Auth::user()->complaintedMessages()->get()->pluck('id');

        $this->messages->each(function ($message) use ($complaintedMsgs) {
            $message->is_not_solved_complaint = $complaintedMsgs->contains($message->id);
        });

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'branch_id' => $this->branch_id,
            'messages' => MessageResource::collection($this->messages->load('user'))->resolve()
        ];
    }
}
