<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HourlyTarget extends Model
{
    protected $fillable = [
        'line_id',
        'hour_slot',
        'effective_date',
        'default_target',
        'actual_target',
        'is_overtime',
        'created_by',
    ];

    public function line()
    {
        return $this->belongsTo(Line::class);
    }
}
