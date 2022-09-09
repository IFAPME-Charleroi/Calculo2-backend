<?php

namespace App\Observers;

use App\Models\Renovation;

class RenovationObserver
{
    /**
     * Handle the Renovation "created" event.
     *
     * @param  \App\Models\Renovation  $renovation
     * @return void
     */
    public function created(Renovation $renovation)
    {
        //
    }

    /**
     * Handle the Renovation "updated" event.
     *
     * @param  \App\Models\Renovation  $renovation
     * @return void
     */
    public function updated(Renovation $renovation)
    {
        //
    }

    /**
     * Handle the Renovation "deleted" event.
     *
     * @param  \App\Models\Renovation  $renovation
     * @return void
     */
    public function deleted(Renovation $renovation)
    {
        //
    }

    /**
     * Handle the Renovation "restored" event.
     *
     * @param  \App\Models\Renovation  $renovation
     * @return void
     */
    public function restored(Renovation $renovation)
    {
        //
    }

    /**
     * Handle the Renovation "force deleted" event.
     *
     * @param  \App\Models\Renovation  $renovation
     * @return void
     */
    public function forceDeleted(Renovation $renovation)
    {
        //
    }
}
