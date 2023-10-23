<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    // Video モデル内に videoRates リレーションを定義する
    public function videoRates()
    {
        return $this->hasMany(VideoRate::class, 'video_id');
    }
}
