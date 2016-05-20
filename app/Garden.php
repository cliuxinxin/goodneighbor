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

    /**
     * Garden belongs to a profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->hasMany('App\Profile');
    }

    /**
     * Get City-Garden name
     *
     * @return string
     */
    public function getCityGardenAttribute()
    {
        return $this->attributes['city'] .'-'. $this->attributes['name'];
    }
}
