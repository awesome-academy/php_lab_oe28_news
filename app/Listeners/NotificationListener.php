<?php

namespace App\Listeners;

use App\Events\NewsNotify;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\InteractsWithQueue;

class NotificationListener
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
     * @param NotificationSent $notificationSent
     * @return void
     */
    public function handle(NotificationSent $notificationSent)
    {
        event(new NewsNotify($notificationSent));
    }
}
