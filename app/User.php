<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * A user has many commnets
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * A user has one profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    /**
     * User can sent many tasks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sendTasks()
    {
        return $this->hasMany('App\Task','sender_id');
    }

    /**
     * User can recieve many taks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recieveTasks()
    {
        return $this->hasMany('App\Task','receiver_id');
    }

    /**
     * The points from user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fromPoints()
    {
        return $this->hasMany('App\Point','from_id');
    }

    /**
     * The points to user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function toPoints()
    {
        return $this->hasMany('App\Point','to_id');
    }


    /**
     * User has many timelines
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timelines()
    {
        return $this->hasMany('App\Timeline');
    }
    /**
     * User get confirm points
     *
     * @return mixed
     */
    public function getPoints()
    {
        return $this->toPoints->filter(function ($value, $key){
            return $value->isconfirm();
        });
    }

    /**
     * User spend confirm points
     *
     * @return mixed
     */
    public function spendPoints()
    {
        return $this->fromPoints->filter(function ($value, $key){
            return $value->isconfirm();
        });
    }

    /**
     * User now have points
     *
     * @return mixed
     */
    public function havePoints()
    {
        return $this->toPoints->sum('points') - $this->fromPoints()->sum('points');
    }

    /**
     * User unconfirm get points
     *
     * @return mixed
     */
    public function unConfirmGetPoints()
    {
        return $this->toPoints->filter(function ($value, $key){
            return $value->notconfirm();
        });
    }

    /**
     * User unconfirm spend points
     *
     * @return mixed
     */
    public function unConfirmSpendPoints()
    {
        return $this->fromPoints->filter(function ($value, $key){
            return $value->notconfirm();
        });
    }

    /**
     * Is the user is a admin
     *
     * @return bool
     */
    public function isAdmin()
    {

        return $this->profile()?$this->profile->role == '管理员':0;
    }


}


