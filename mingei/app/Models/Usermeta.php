<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usermeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // 他のカラムを必要に応じて追加
    ];

}
