<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'birth', 'death', 'avatar', 'description',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
