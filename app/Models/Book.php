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
        'name', 'isbn', 'avatar', 'pages', 'description', 'edition', 'publisher',
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }
}
