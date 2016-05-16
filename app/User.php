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
}
