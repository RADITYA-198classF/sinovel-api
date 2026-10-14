<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingList extends Model
{
    protected $fillable = ['user_id', 'name', 'is_private'];
    protected $casts = ['is_private' => 'boolean'];

    public function novels()
    {
        return $this->belongsToMany(Novel::class, 'novel_reading_list')->withTimestamps();
    }
}