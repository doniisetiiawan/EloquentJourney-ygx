<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdentityDocument extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
