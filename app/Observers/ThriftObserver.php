<?php

namespace App\Observers;

use App\Thrift;
use App\Notifications\BeneficiaryNotification;

class ThriftObserver
{
    /**
     * Handle the thrift "created" event.
     *
     * @param  \App\Thrift  $thrift
     * @return void
     */
    public function created(Thrift $thrift)
    {
        $user = $thrift->beneficiary->group->user;
        $message = 'Your beneficiary with the name <b>'.ucwords($thrift->beneficiary->name).'</b> has made a deposit of <b>'.number_format($thrift->amount,2).'</b> and is pending administrative approval.';
        $title = 'Thrift Deposited';
        $user->notify(new BeneficiaryNotification($message, $title, explode(' ', $user->name)[0], '<div class="notify-icon bg-warning"><i class="mdi mdi-check-box-outline"></i></div>'));
    }

    /**
     * Handle the thrift "updated" event.
     *
     * @param  \App\Thrift  $thrift
     * @return void
     */
    public function updated(Thrift $thrift)
    {
        $user = $thrift->beneficiary->group->user;
        $beneficiary = $thrift->beneficiary;
        if($thrift->isDirty('status')){
            if($thrift->status == 'approved'){
                if($beneficiary->data()->level == '1'){
                    $sum = $beneficiary->thrifts()->sum('amount');
                    if($sum == 20000){
                        $beneficiary->update(['details->level'=>'2', 'details->level_thrift_status'=>'pending', 'details->level_payment_status'=>'pending']);
                    }
                }elseif($beneficiary->data()->level == '2'){
                    $sum = $beneficiary->thrifts()->sum('amount');
                    if($sum == 50000){
                        $beneficiary->update(['details->level'=>'complete', 'details->level_thrift_status'=>'pending', 'details->level_payment_status'=>'pending']);
                    }
                }
                $message = '<b>'.ucwords($thrift->beneficiary->name).'</b> deposit of <b>'.number_format($thrift->amount,2).'</b> has been approved.';
                $title = 'Thrift Approved';
                $user->notify(new BeneficiaryNotification($message, $title, explode(' ', $user->name)[0], '<div class="notify-icon bg-success"><i class="mdi mdi-check-box-outline"></i></div>'));
            }else {
                $message = '<b>'.ucwords($thrift->beneficiary->name).'</b> deposit of <b>'.number_format($thrift->amount,2).'</b> has been declined.';
                $title = 'Thrift Declined';
                $user->notify(new BeneficiaryNotification($message, $title, explode(' ', $user->name)[0], '<div class="notify-icon bg-danger"><i class="mdi mdi-check-box-outline"></i></div>'));
            }
        }
    }

    /**
     * Handle the thrift "deleted" event.
     *
     * @param  \App\Thrift  $thrift
     * @return void
     */
    public function deleted(Thrift $thrift)
    {
        //
    }

    /**
     * Handle the thrift "restored" event.
     *
     * @param  \App\Thrift  $thrift
     * @return void
     */
    public function restored(Thrift $thrift)
    {
        //
    }

    /**
     * Handle the thrift "force deleted" event.
     *
     * @param  \App\Thrift  $thrift
     * @return void
     */
    public function forceDeleted(Thrift $thrift)
    {
        //
    }
}
