<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingProgress extends Model
{
    protected $table = 'reading_progress';
    protected $fillable = ['user_id', 'novel_id', 'current_chapter', 'is_finished'];
    protected $casts = ['is_finished' => 'boolean'];

    public function novel()
    {
        return $this->belongsTo(Novel::class);
    }
}