<?php

namespace Vaweto\Medium\Models;

use Illuminate\Database\Eloquent\Model;

class MediumFeed extends Model
{
    protected $fillable = [
        'name',
        'type',
        'user_id',
    ];
}
