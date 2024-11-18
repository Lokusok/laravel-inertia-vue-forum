<?php

namespace App\Jobs;

use App\Events\StoreMessageEvent;
use App\Models\Image;
use App\Models\Message;
use App\Models\User;
use App\Service\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use function App\getId;

class ProcessMessageJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private $data,
        private $message
    ) {}

    public function handle(): void
    {
        $ids = User::getCleanedUserId($this->data);

        $imgIds = getId($this->data, '/img_id=[\d]+/', '/img_id=/');

        broadcast(new StoreMessageEvent($this->message))->toOthers();

        Image::whereIn('id', $imgIds)->update([
            'message_id' => $this->message->id
        ]);

        Image::updateMessageId($imgIds, $this->message);

        Image::cleanFromStorage();

        Image::cleanFromTable();

        $this->message->answeredUsers()->attach($ids);

        $ids->each(function ($id) {
            NotificationService::store($this->message, $id, 'Вам ответили');
        });
    }
}
