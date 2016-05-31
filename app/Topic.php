<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable=[
        'type',
        'detail',
        'url',
        'comment'
    ];

    /**
     * Topic belongs to many users
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function isSeenBy($auth_user)
    {
        foreach($this->users()->get() as $user){
            if ($user->id == $auth_user->id){
                return true;
            }
        }

        return false;
    }
}
