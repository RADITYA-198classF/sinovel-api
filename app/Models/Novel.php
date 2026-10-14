<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    protected $fillable = ['title', 'author', 'cover', 'synopsis', 'status', 'views', 'likes', 'rating'];

    protected $casts = [
    'rating' => 'float',
];


    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class)->orderBy('number');
    }
}