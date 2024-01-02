<?php

namespace Vaweto\Medium\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediumFeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'user_id',
    ];
}
