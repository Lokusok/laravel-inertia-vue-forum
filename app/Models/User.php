<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use function App\getId;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'user_id', 'id')->where('is_read', '=', false);
    }

    public function likedMessages(): BelongsToMany
    {
        return $this->belongsTomany(Message::class, 'message_user_likes', 'user_id', 'message_id');
    }

    public function complaintedMessages()
    {
        return $this->belongsTomany(Message::class, 'complaints', 'user_id', 'message_id');
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? url('storage/' . $this->avatar) : null;
    }

    public static function getCleanedUserId($data)
    {
        $result = getId($data, '/@[\d]+/', '/@/')->filter(function ($id) {
            return User::where('id', '=', $id)->exists();
        });

        return $result;
    }
}
