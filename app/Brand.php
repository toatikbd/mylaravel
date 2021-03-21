<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
}
