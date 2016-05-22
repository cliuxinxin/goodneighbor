<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * status:空，完成
     * @var array
     */
    protected $fillable=[
        'content',
        'sender_id',
        'receiver_id',
        'status',
        'point_id'
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
    public function receiver()
    {
        return $this->belongsTo('App\User','receiver_id');
    }

    /**
     * A task has many comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Task has points
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function point()
    {
        return $this->hasOne('App\Point');
    }

    /**
     * Task has many timelines
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timelines()
    {
        return $this->hasMany('App\Timeline');
    }
    /**
     * Is the task send by user
     *
     * @param \App\User $user
     * @return bool
     */
    public function isSendByUser(User $user)
    {
        return $this->getAttribute('sender_id') == $user->id;
    }

    /**
     * Is the task not send by user
     *
     * @param \App\User $user
     * @return bool
     */
    public function notSendByUser(User $user)
    {
        return $this->getAttribute('sender_id') != $user->id;
    }

    /**
     * Is the task confirmed?
     *
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->getAttribute('status') == '完成';
    }

    /**
     * Is the task processing
     *
     * @return bool
     */
    public function isProcessing()
    {
        return $this->getAttribute('receiver_id') != '' && $this->getAttribute('status') == '';
    }


    /**
     * task not received
     *
     * @return bool
     */
    public function isNotReceived()
    {
        return $this->getAttribute('receiver_id') == '';
    }

    /**
     * Task not received and user is the sender
     *
     * @param \App\User $user
     * @return bool
     */
    public function isCanConfirm(User $user)
    {
        return $this->isProcessing() && $this->isSendByUser($user);
    }

    /**
     * User send the task can delete the unreceived task
     *
     * @param \App\User $user
     * @return bool
     */
    public function isCanDelete(User $user)
    {
        return $this->isNotReceived() && $this->isSendByUser($user);
    }

    /**
     * User can remove the receiver of the task on process.
     *
     * @param \App\User $user
     * @return bool
     */
    public function isCanRemove(User $user)
    {
        return $this->isProcessing() && $this->isSendByUser($user);
    }

    /**
     * This use is the receiver
     *
     * @param \App\User $user
     * @return bool
     */
    public function isReceivedByUser(User $user)
    {
        return $this->getAttribute('receiver_id') == $user->id;
    }

}

