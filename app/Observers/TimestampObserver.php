<?php

namespace App\Observers;

use App\Models\Question;
use App\Models\Timestamp;

class TimestampObserver
{
    /**
     * Handle the Timestamp "created" event.
     */
    public function created(Timestamp $timestamp): void
    {
        //Question::recalculatePercentages();
    }

    /**
     * Handle the Timestamp "updated" event.
     */
    public function updated(Timestamp $timestamp): void
    {
        //Question::recalculatePercentages();
    }

    /**
     * Handle the Timestamp "deleted" event.
     */
    public function deleted(Timestamp $timestamp): void
    {
        //Question::recalculatePercentages();
    }

    /**
     * Handle the Timestamp "restored" event.
     */
    public function restored(Timestamp $timestamp): void
    {
        //
    }

    /**
     * Handle the Timestamp "force deleted" event.
     */
    public function forceDeleted(Timestamp $timestamp): void
    {
        //
    }
}
