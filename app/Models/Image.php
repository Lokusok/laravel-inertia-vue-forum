<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $table = 'images';

    protected $guarded = [];

    public function getUrlAttribute()
    {
        return url('storage/' . $this->path);
    }

    public function scopeCleanFromStorage(Builder $builder): void
    {
        $builder->where('user_id', Auth::user()->id)
            ->whereNull('message_id')
            ->get()
            ->pluck('path')
            ->each(function ($path) {
                Storage::disk('public')->delete($path);
            });
    }

    public function scopeCleanFromTable(Builder $builder): void
    {
        $builder->where('user_id', Auth::user()->id)
            ->whereNull('message_id')
            ->delete();
    }

    public function scopeUpdateMessageId(Builder $builder, $imgIds, Message $message): void
    {
        $builder->whereIn('id', $imgIds)->update([
            'message_id' => $message->id
        ]);
    }
}
