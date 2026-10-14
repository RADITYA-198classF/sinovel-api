<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['user_id', 'novel_id', 'type'];

    public function novel()
    {
        return $this->belongsTo(Novel::class);
    }
}