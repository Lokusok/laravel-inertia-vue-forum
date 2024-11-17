<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    protected $table = 'messages';

    protected $guarded = [];

    protected $withCount = [
        'likedUsers'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function likedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'message_user_likes', 'message_id', 'user_id');
    }

    public function answeredUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'message_user_answers', 'message_id', 'user_id');
    }

    public function complaintedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'complaints', 'message_id', 'user_id');
    }

    public function getIsLikedAttribute()
    {
        return $this->likedUsers()->where('user_id', '=', Auth::user()->id)->exists();
    }

    public function getIsNotSolvedComplaintAttribute()
    {
        return $this->complaintedUsers()
            ->where('user_id', '=',  Auth::user()->id)
            ->where('is_solved', '=', false)
            ->exists();
    }
}
