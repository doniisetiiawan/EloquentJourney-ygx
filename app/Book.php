<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $casts = [
        'is_rare' => 'boolean',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

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
        return $query->scopeLong()->where('price', '<', $amount);
    }

    public function getPriceAttribute($value)
    {
        return '$ ' . $value;
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtolower($value);
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $attributes = $this->attributesToArray();
        return array_merge($attributes, $this->relationsToArray());
    }

    /**
     * Convert the model instance to JSON.
     *
     * @param int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }
}
