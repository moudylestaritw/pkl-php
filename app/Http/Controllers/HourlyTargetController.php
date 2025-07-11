<?php

use Illuminate\Http\Request;
use App\Models\HourlyTarget;
use App\Jobs\ResetActualTargetToDefault;

public function updateActualTarget(Request $request)
{
    $request->validate([
        'line_id' => 'required|integer',
        'hour_slot' => 'required|string',
        'effective_date' => 'required|date',
        'actual_target' => 'required|integer'
    ]);

    $target = HourlyTarget::where('line_id', $request->line_id)
        ->where('hour_slot', $request->hour_slot)
        ->whereDate('effective_date', $request->effective_date)
        ->first();

    if (!$target) {
        return response()->json(['message' => 'Hourly target not found.'], 404);
    }

    $target->actual_target = $request->actual_target;
    $target->save();

    // Dispatch reset job in 1 minute
    ResetActualTargetToDefault::dispatch($target->id)->delay(now()->addMinute());

    return response()->json(['message' => 'Actual target updated. Will reset in 1 minute.']);
}
