<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use DB;
use Mail;
use App\Mail\userAlert;

class SendEmail
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
     * @param  \App\Events\UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        // print_r($event->email);  // check for debug
        // //We can send a mail from here
        // echo ".. From Listeners";

        $saveHistory = DB::table('newsletters')->insert(
                ['email' => $event->email]
            );
        Mail::to($event->email)->send(new userAlert($event->email));
    }
}
