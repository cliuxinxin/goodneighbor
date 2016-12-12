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
     * Scope the hospital
     *
     * @param $query
     * @return mixed
     */
    public function scopeHospital($query)
    {
        return $query->where('detail','LIKE','%医院%')->orWhere('detail','LIKE','%设备%')->orWhere('detail','LIKE','%竞争%');
    }
    /**
     * Scope the zhaobiao
     *
     * @param $query
     * @return mixed
     */
    public function scopeZhaoBiao($query)
    {
        return $query->where('type','LIKE','%招标%');
    }

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
