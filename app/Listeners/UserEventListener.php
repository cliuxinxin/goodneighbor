<?php

namespace App\Listeners;

use App\EventRecord;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        EventRecord::create([
            'type' => '用户登录',
            'user_id' => $event->user->id,
            'action' => '登录'
        ]);
    }
}
