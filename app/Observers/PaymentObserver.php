<?php

namespace App\Observers;

use App\Payment;
use App\Notifications\BeneficiaryNotification;

class PaymentObserver
{
    /**
     * Handle the payment "created" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function created(Payment $payment)
    {
        $user = $payment->beneficiary->group->user;
        $beneficiary = $payment->beneficiary;
        if($beneficiary->data()->level == '3'){
            $beneficiary->update(['details->level'=>'complete', 'details->level_thrift_status'=>'paid', 'details->level_payment_status'=>'paid']);
        }
        $message = 'Your beneficiary with the name <b>'.ucwords($payment->beneficiary->name).'</b> has been paid the sum of <b>'.number_format($payment->amount,2).'</b>';
        $title = 'Beneficiary Paid';
        $user->notify(new BeneficiaryNotification($message, $title, explode(' ', $user->name)[0], '<div class="notify-icon bg-info"><i class="mdi mdi-peace"></i></div>'));
        $beneficiary->notify(new BeneficiaryNotification("You just received a fund of N".number_format($payment->amount,2)." from The Empowerment Network.", "Payment Received", explode(' ', $beneficiary->name)[0], '<div class="notify-icon bg-info"><i class="mdi mdi-peace"></i></div>'));
    }

    /**
     * Handle the payment "updated" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function updated(Payment $payment)
    {
        //
    }

    /**
     * Handle the payment "deleted" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function deleted(Payment $payment)
    {
        //
    }

    /**
     * Handle the payment "restored" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function restored(Payment $payment)
    {
        //
    }

    /**
     * Handle the payment "force deleted" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function forceDeleted(Payment $payment)
    {
        //
    }
}
