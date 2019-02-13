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
     * Get all of the authors tha are assigned this category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function authors()
    {
        return $this->morphedByMany(Author::class, 'entity', 'entity_category');
    }

    /**
     * Get all of the books that are assigned this category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function books()
    {
        return $this->morphedByMany(Book::class, 'entity', 'entity_category');
    }
}
