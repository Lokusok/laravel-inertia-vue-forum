<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'sections';

    protected $guarded = [];

    public function branches()
    {
        return $this->hasMany(Branch::class, 'section_id', 'id');
    }
}
