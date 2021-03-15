<?php

namespace App\Observers;

use App\User;
use App\Wallet;
use App\Notifications\WelcomeMail;
use App\Notifications\BeneficiaryNotification;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        if(!$user->is_admin){
            $user->assignRole('user');
            $user->notify(new WelcomeMail(explode(' ', $user->name)[0]));
            $user->tokenize("mobile");
        }
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        if($user->isDirty('details')){
            if($user->getOriginal('details') != null){
                if($user->data()->status == 'approved'){
                    $message = 'Your account has been approved.';
                    $title = 'Account Approved';
                    $icon = '<div class="notify-icon bg-success"><i class="mdi mdi-check-all"></i></div>';
                    $user->notify(new BeneficiaryNotification($message, $title, explode(' ', $user->name)[0], $icon));
                }
            }
        }elseif($user->isDirty('phone_verified_at')){
            $message = 'Your phone number verification was successful.';
            $title = 'Phone Verified';
            $icon = '<div class="notify-icon bg-warning"><i class="mdi mdi-cellphone-iphone"></i></div>';
            $user->notify(new BeneficiaryNotification($message, $title, explode(' ', $user->name)[0], $icon));
        }

    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
