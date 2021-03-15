<?php

namespace App\Observers;

use App\Group;

class GroupObserver
{
    /**
     * Handle the group "created" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function created(Group $group)
    {
        //
    }

    /**
     * Handle the group "updated" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function updated(Group $group)
    {
        //
    }

    /**
     * Handle the group "deleted" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function deleted(Group $group)
    {
        //
    }

    /**
     * Handle the group "restored" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function restored(Group $group)
    {
        //
    }

    /**
     * Handle the group "force deleted" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function forceDeleted(Group $group)
    {
        //
    }
}
