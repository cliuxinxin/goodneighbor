<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'garden_id',
        'room',
        'phone'
    ];

    /**
     * A profile belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
