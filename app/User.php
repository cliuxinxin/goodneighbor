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
}
