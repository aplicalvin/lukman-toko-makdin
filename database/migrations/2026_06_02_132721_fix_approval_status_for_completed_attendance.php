<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \Illuminate\Support\Facades\DB::table('daily_attendance')
            ->whereNotNull('check_out_time')
            ->where('approval_status', 'Pending')
            ->whereNotIn('status', ['Hadir (Manual)', 'Izin', 'Cuti', 'Sakit'])
            ->update(['approval_status' => 'Done']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
