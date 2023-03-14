<?php

namespace App\Providers;

use App\Providers\PodcastProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPodcastNotification
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
     * @param  \App\Providers\PodcastProcessed  $event
     * @return void
     */
    public function handle(PodcastProcessed $event)
    {
        //
    }
}
