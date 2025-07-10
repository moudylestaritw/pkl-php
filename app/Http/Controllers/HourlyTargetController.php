<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HourlyTarget;

class HourlyTargetController extends Controller
{
    public function setDefault(Request $request)
    {
        $validated = $request->validate([
            'line_id' => 'required|exists:lines,id',
            'effective_date' => 'required|date',
            'targets' => 'required|array',
        ]);

        foreach ($validated['targets'] as $hourSlot => $target) {
            HourlyTarget::create([
                'line_id' => $validated['line_id'],
                'hour_slot' => $hourSlot,
                'effective_date' => $validated['effective_date'],
                'default_target' => $target,
                'actual_target' => null,
                'is_overtime' => false,
                'created_by' => 1
            ]);
        }

        return response()->json(['message' => 'Hourly targets created successfully.']);
    }

    public function updateActual(Request $request)
    {
        $validated = $request->validate([
            'line_id' => 'required|integer',
            'hour_slot' => 'required|string',
            'effective_date' => 'required|date',
            'actual_target' => 'required|integer',
        ]);

        $target = HourlyTarget::where('line_id', $validated['line_id'])
            ->where('hour_slot', $validated['hour_slot'])
            ->where('effective_date', $validated['effective_date'])
            ->first();

        if (!$target) {
            return response()->json([
                'message' => 'Hourly target not found for given parameters.'
            ], 404);
        }

        $target->actual_target = $validated['actual_target'];
        $target->save();

        return response()->json([
            'message' => 'Actual target updated successfully.',
            'data' => $target
        ]);
    }
}
