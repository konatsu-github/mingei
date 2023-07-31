<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoRate extends Model
{
    use HasFactory;

    protected $fillable = ['video_id', 'rating_type', 'user_id'];
}
