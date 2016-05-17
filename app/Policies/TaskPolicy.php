<?php

namespace App\Policies;

use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     *
     * User must delete his own task
     *
     * @param User $user
     * @param Task $task
     * @return bool
     */
    public function destroy(User $user, Task $task)
    {
        return $task->isCanDelete($user);
    }

    /**
     * User can't receive his own work
     *
     * @param User $user
     * @param Task $task
     * @return bool
     */
    public function receiver(User $user, Task $task)
    {
        return $task->notSendByUser($user);
    }

    /**
     * Only sender can confirm the task
     *
     * @param User $user
     * @param Task $task
     * @return bool
     */
    public function confirm(User $user, Task $task)
    {
        return $user->id === $task->sender_id;
    }
}
