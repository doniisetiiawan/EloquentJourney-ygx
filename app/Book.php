<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function scopeCheapButBig($query)
    {
        return $query->where('price', '<', 10)->where('pages_count', '>', 300);
    }

    public function scopeCheap($query)
    {
        return $query->where('price', '<', 10);
    }

    public function scopeExpensive($query)
    {
        return $query->where('price', '>', 100);
    }

    public function scopeLong($query)
    {
        return $query->where('pages_count', '>', 700);
    }

    public function scopeShort($query)
    {
        return $query->where('pages_count', '<', 100);
    }

    public function scopeLongAndCheaperThan($query, $amount)
    {
        return $query->long()->where('price', '<', $amount);
    }
}
