<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Info extends Model
{
    protected $fillable=[
        'title',
        'summary',
        'url'
    ];


    /**
     * This week infos
     *
     * @param $query
     */
    public function scopeThisweek($query)
    {
        $query->where('created_at','>=',Carbon::now()->addDays(-8));
    }

    /**
     * Info belongs to many users
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
