<?php

namespace App\Observers;

use App\Beneficiary;
use App\Notifications\BeneficiaryNotification;

class BeneficiaryObserver
{
    /**
     * Handle the beneficiary "created" event.
     *
     * @param  \App\Beneficiary  $beneficiary
     * @return void
     */
    public function created(Beneficiary $beneficiary)
    {
        $user = $beneficiary->group->user;
        $message = 'You have successfully added a new beneficiary with the name <b>'.ucwords($beneficiary->name).'</b> to the system.';
        $title = 'New Beneficiary';
        $user->notify(new BeneficiaryNotification($message, $title, explode(' ', $user->name)[0], '<div class="notify-icon bg-success"><i class="mdi mdi-book-outline"></i></div>'));
        $beneficiary->notify(new BeneficiaryNotification("You have been added as a beneficiary on The Empowerment Network.", "Welcome Mail", explode(' ', $beneficiary->name)[0], '<div class="notify-icon bg-success"><i class="mdi mdi-book-outline"></i></div>'));
    }

    /**
     * Handle the beneficiary "updated" event.
     *
     * @param  \App\Beneficiary  $beneficiary
     * @return void
     */
    public function updated(Beneficiary $beneficiary)
    {
        //
    }

    /**
     * Handle the beneficiary "deleted" event.
     *
     * @param  \App\Beneficiary  $beneficiary
     * @return void
     */
    public function deleted(Beneficiary $beneficiary)
    {
        //
    }

    /**
     * Handle the beneficiary "restored" event.
     *
     * @param  \App\Beneficiary  $beneficiary
     * @return void
     */
    public function restored(Beneficiary $beneficiary)
    {
        //
    }

    /**
     * Handle the beneficiary "force deleted" event.
     *
     * @param  \App\Beneficiary  $beneficiary
     * @return void
     */
    public function forceDeleted(Beneficiary $beneficiary)
    {
        //
    }
}
