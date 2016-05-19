<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Garden extends Model
{
    protected $fillable=[
        'name',
        'city',
        'price'
    ];
}
