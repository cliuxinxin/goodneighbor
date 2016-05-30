<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventRecord extends Model
{
    protected $fillable=[
        'type',
        'user_id',
        'action'
    ];

    /**
     * A Event record belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
