<?php

namespace App\Events;

use App\Http\Resources\Message\MessageResource;
use App\Http\Resources\Notification\NotificationResource;
use App\Models\Message;
use App\Models\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoreLikeEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        private Message $message
    ) {}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('themes.' . $this->message->theme_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'store_like';
    }

    public function broadcastWith(): array
    {
        return [
            'data' => MessageResource::make($this->message->loadCount('likedUsers'))->resolve()
        ];
    }
}
