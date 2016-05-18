<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{

    protected $fillable = [
        'from_id',
        'to_id',
        'points',
        'status',
        'details'
    ];
    /**
     * User who send points
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo('App\User','from_id');
    }

    /**
     * User who recive points
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reciever()
    {
        return $this->belongsTo('App\User','to_id');
    }

    /**
     * Point belongs to a task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo('App\Task','task_id');
    }

    /**
     * Point is confirm
     *
     * @return bool
     */
    public function isConfirm()
    {
        return $this->getAttribute('status') == null;
    }

    /**
     * Point is not confirm
     *
     * @return bool
     */
    public function notConfirm()
    {
        return $this->getAttribute('status') == '在途';
    }
}
