<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoLike extends Model
{
    protected $fillable = ['user_id', 'videos_id'];
    public $timestamps = false; // отключить метки времени, если не нужны
}
