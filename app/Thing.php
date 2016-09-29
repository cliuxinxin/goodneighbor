<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thing extends Model
{
    protected $fillable=[
        'user_id',
        'body'
    ];
}
