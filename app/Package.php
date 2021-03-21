<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
}
