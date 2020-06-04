<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\SerializesModels;

class NewsNotify implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notification;

    /**
     * Create a new event instance.
     *
     * @param NotificationSent $notificationSent
     */
    public function __construct(NotificationSent $notificationSent)
    {
        $this->notification = $notificationSent->response;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['send-message'];
    }

    public function broadcastAs()
    {
        return 'news-event';
    }
}
