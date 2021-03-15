<?php

namespace App\Observers;

use App\VerificationToken;
use App\Notifications\VerificationTokenNotification;

class VerificationTokenObserver
{
    /**
     * Handle the VerificationToken "created" event.
     *
     * @param  \App\Entities\User\VerificationToken  $verificationToken
     * @return void
     */
    public function created(VerificationToken $verificationToken)
    {
        $user = $verificationToken->user;
        if(!$user->is_admin){
            $user = $verificationToken->user;
            if($verificationToken->type == 'mobile'){
                $user->smsNotify("TEN One-time security code: ".$verificationToken->token);
            }elseif($verificationToken->type == 'email'){
                $user->notify(new VerificationTokenNotification(explode(' ', $user->name)[0], $verificationToken->token));
            }else {
                $user->notify(new VerificationTokenNotification(explode(' ', $user->name)[0], $verificationToken->token));
                $user->smsNotify("TEN One-time security code: ".$verificationToken->token);
            }
        }
    }

    /**
     * Handle the VerificationToken "updated" event.
     *
     * @param  \App\Entities\User\VerificationToken  $verificationToken
     * @return void
     */
    public function updated(VerificationToken $verificationToken)
    {
        //
    }

    /**
     * Handle the VerificationToken "deleted" event.
     *
     * @param  \App\Entities\User\VerificationToken  $verificationToken
     * @return void
     */
    public function deleted(VerificationToken $verificationToken)
    {
        //
    }

    /**
     * Handle the VerificationToken "restored" event.
     *
     * @param  \App\Entities\User\VerificationToken  $verificationToken
     * @return void
     */
    public function restored(VerificationToken $verificationToken)
    {
        //
    }

    /**
     * Handle the VerificationToken "force deleted" event.
     *
     * @param  \App\Entities\User\VerificationToken  $verificationToken
     * @return void
     */
    public function forceDeleted(VerificationToken $verificationToken)
    {
        //
    }
}