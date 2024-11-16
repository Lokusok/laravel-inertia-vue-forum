<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    use SoftDeletes;

    protected $table = 'themes';

    protected $guarded = [];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'theme_id', 'id');
    }
}
