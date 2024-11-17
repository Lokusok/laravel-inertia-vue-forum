<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notification\UpdateCollectionRequest;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function updateCollection(UpdateCollectionRequest $request)
    {
        $data = $request->validated();

        Notification::whereIn('id', $data['ids'])->update([
            'is_read' => true
        ]);

        return response()->json([
            'count' => Auth::user()->notifications()->count()
        ]);
    }
}
