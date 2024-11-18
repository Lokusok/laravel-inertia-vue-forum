<?php

namespace App\Http\Controllers;

use App\Events\StoreLikeEvent;
use App\Http\Requests\Complaint\StoreRequest as ComplaintStoreRequest;
use App\Http\Requests\Message\StoreRequest;
use App\Http\Resources\Message\MessageResource;
use App\Jobs\ProcessMessageJob;
use App\Models\Message;
use App\Service\NotificationService;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;

        $message = Message::query()->create($data);

        ProcessMessageJob::dispatch($data, $message);

        return MessageResource::make($message)->resolve();
    }

    public function toggleLike(Message $message)
    {
        $res = $message->likedUsers()->toggle(Auth::user()->id);

        if (count($res['attached']) > 0) {
            NotificationService::store($message, null, 'Вам поставили лайк');
        }

        broadcast(new StoreLikeEvent($message))->toOthers();
    }

    public function storeComplaint(ComplaintStoreRequest $request, Message $message)
    {
        $data = $request->validated();
        $message->complaintedUsers()->attach(Auth::user()->id, $data);

        NotificationService::store($message, null, 'На вас пожаловались');

        $message->is_not_solved_complaint = true;

        return MessageResource::make($message)->resolve();
    }
}
