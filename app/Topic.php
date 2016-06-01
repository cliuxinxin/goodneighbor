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

    /**
     * Is this user see
     *
     * @param $auth_user
     * @return bool
     */
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
