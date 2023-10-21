<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class RegistrationSuccess
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $userEmail = $event->user->email;

        Mail::send([], [], function ($message) use ($userEmail) {
            $message->to($userEmail)
                ->subject('みんなのげいにんどうがにご登録いただき誠にありがとうございます')
                ->setBody("※このメールはシステムからの自動返信です\n\nみんなのげいにんどうがにご登録いただき誠にありがとうございます。\n早速好きな芸人さんをフォローしたり、芸人の方は動画をアップロードしてみてください！");
        });

        $notificationData = "「みんなのげいにんどうが」にご登録いただきありがとうございます。<br>好きな芸人さんをフォローしたり、動画をアップロードしたりしてみてください。";
        $userId = $event->user->id; // ユーザーID
        CreateNotification($notificationData, $userId);
    }
}
