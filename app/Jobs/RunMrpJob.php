<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class RunMrpJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mrpController = app()->make('App\Http\Controllers\MrpMstrController');
        $mrpController->generateMrp();

        // Log or notify that the MRP job has been executed
        \Log::info('MRP Job executed successfully.');
    }
}
