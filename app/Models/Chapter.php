<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = ['novel_id', 'number', 'title', 'content'];
}