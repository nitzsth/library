<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Categories can have many authors.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function authors()
    {
        return $this->morphedByMany(Author::class, 'entity', 'entity_category');
    }

    /**
     * Categories can have many books.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function books()
    {
        return $this->morphedByMany(Book::class, 'entity', 'entity_category');
    }
}
