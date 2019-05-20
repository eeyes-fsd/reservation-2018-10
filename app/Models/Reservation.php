<?php

namespace App\Models;

class Reservation extends Model
{
    protected $fillable = ['name', 'organization', 'user_id', 'population', 'phone', 'year', 'month', 'day', 'blocks', 'credential', 'remarks', 'review'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setBlocksAttribute($value)
    {
        $this->attributes['blocks'] = serialize($value);
    }

    public function getBlocksAttribute($blocks)
    {
        return unserialize($blocks);
    }
}
