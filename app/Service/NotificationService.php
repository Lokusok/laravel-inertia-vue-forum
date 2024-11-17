<?php

namespace App\Service;

use App\Models\Message;
use App\Models\Notification;

class NotificationService
{
    public static function store(Message $message, $id = null, $title = '')
    {
        $id = $id ?? $message->user_id;

        Notification::create([
            'title' => $title,
            'user_id' => $id,
            'url' => route('themes.show', $message->theme_id) . '#' . $message->id
        ]);
    }
}
