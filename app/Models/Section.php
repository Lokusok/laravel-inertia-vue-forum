<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes;

    protected $table = 'sections';

    protected $guarded = [];

    public function branches()
    {
        return $this->hasMany(Branch::class, 'section_id', 'id');
    }
}
