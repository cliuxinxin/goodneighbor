<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $fillable = [
        'user_id',
        'task_id',
        'type',
        'action',
        'time'
    ];

    protected $dates = ['time'];

    /**
     * timeline belongs to task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo('App\Task');
    }


    public function setTimeAttribute($date)
    {
        $this->attributes['time'] = Carbon::parse($date);
    }
}
