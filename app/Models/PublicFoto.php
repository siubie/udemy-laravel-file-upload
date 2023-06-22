<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicFoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'user_id'
    ];
}
