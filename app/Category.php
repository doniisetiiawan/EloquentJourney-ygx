<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
//    public function books()
//    {
//        return $this->belongsToMany(Book::class);
//    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'imageable');
    }

    public function authors()
    {
        return $this->morphedByMany(Author::class, 'categorizable');
    }

    public function books()
    {
        return $this->morphedByMany(Book::class, 'categorizable');
    }
}
