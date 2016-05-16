<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=[
        'content',
        'sender_id',
        'receiver_id'
    ];

    /**
     * Task belongs to a user who sends.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo('App\User','sender_id');
    }

    /**
     * Task belongs to a user who receives.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reciever()
    {
        return $this->belongsTo('App\User','receiver_id');
    }

}
