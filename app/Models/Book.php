<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'isbn',
        'avatar',
        'pages',
        'description',
        'edition',
        'publisher',
    ];

    /**
     * The authors that belong to the book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    /**
     * Get all of the categories for the book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'entity', 'entity_category');
    }

    /**
     * Get the bookcopies for the book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookCopies()
    {
        return $this->hasMany(BookCopy::class);
    }
}
