<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function research()
    {
        return $this->belongsTo(Research::class);
    }
}
