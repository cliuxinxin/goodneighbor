<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'garden_id',
        'room',
        'phone',
        'img_url'
    ];

    /**
     * A profile belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * A user has a garden
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function garden()
    {
        return $this->belongsTo('App\Garden');
    }
}
