<?php

namespace App;

use App\Aweloquent\AweloquentModel;
use Illuminate\Database\Eloquent\Model;

class Author extends AweloquentModel
{
    protected $fillable = [
        'first_name', 'last_name', 'bio'
    ];

    protected static $rules = [
        'everytime' => [
            'first_name' => 'required'
        ],
        'create'    => [
            'last_name' => 'required'
        ],
        'update'    => [
            'bio' => 'required'
        ],
    ];

    protected static $messages = [
        'first_name.required' => 'You forgot the first name!',
        'last_name.required'  => 'You forgot the last name!'
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }
}
