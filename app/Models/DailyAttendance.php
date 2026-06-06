<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyAttendance extends Model
{
    protected $table = 'daily_attendance';

    protected $fillable = [
        'employee_id',
        'date',
        'check_in_time',
        'check_out_time',
        'total_hours',
        'status',
        'notes',
        'approval_status',
        'attachment',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Scope: problematic attendance records.
     * Matches records that are either pending approval OR have check-in but no
     * check-out on a past date (forgot to clock out). Excludes leave types.
     * This scope is shared by the dashboard count and the Presensi Bermasalah page
     * to keep both in sync.
     */
    public function scopeProblematic($query)
    {
        $today = \Carbon\Carbon::today()->format('Y-m-d');

        return $query
            ->whereNotIn('status', ['Izin', 'Sakit', 'Cuti'])
            ->where(function ($q) use ($today) {
                $q->where('approval_status', 'Pending')
                  ->orWhere(function ($subQ) use ($today) {
                      $subQ->whereNotNull('check_in_time')
                           ->whereNull('check_out_time')
                           ->where('date', '<', $today);
                  });
            });
    }
}
