<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function designation(){
        return $this->belongsTo(Designation::class);
    }
    
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
}
