<?php

namespace Vaweto\Medium\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MediumFeed extends Model
{
    protected $fillable = [
        'name',
        'type',
        'user_id'
    ];
}
