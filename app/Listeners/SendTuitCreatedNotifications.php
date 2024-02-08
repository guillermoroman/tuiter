<?php

namespace App\Listeners;

use App\Events\TuitCreated;
use App\Models\User;
use App\Notifications\NewTuit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTuitCreatedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TuitCreated $event): void
    {
        foreach (User::whereNot('id', $event->tuit->user_id)->cursor() as $user) {
            $user->notify(new NewTuit($event->tuit));
        }
    }
}
