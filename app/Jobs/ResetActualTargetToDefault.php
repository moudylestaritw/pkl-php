<?php

namespace App\Jobs;

use App\Models\HourlyTarget;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ResetActualTargetToDefault implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $targetId;

    public function __construct($targetId)
    {
        $this->targetId = $targetId;
    }

    public function handle()
    {
        $target = HourlyTarget::find($this->targetId);

        if ($target) {
            $target->actual_target = $target->default_target;
            $target->save();
        }
    }
}
