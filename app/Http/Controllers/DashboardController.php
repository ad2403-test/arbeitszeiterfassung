<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WorkBreak;
use App\Models\WorkLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    
public function index(Request $request)
{
    $currentUser = Auth::user();

    // Selected month/year (fallback = current)
    $year  = $request->get('year', now()->year);
    $month = $request->get('month', now()->month);

    $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth();
    $endOfMonth   = Carbon::create($year, $month, 1)->endOfMonth();

    $usersCount = User::count();

    $activeUsers = WorkLog::where('user_id', $currentUser->id)
        ->whereNull('clock_out')
        ->count();

    $currentDayOfWeekAsStringInGerman = [
        'Sunday' => 'Sonntag',
        'Monday' => 'Montag',
        'Tuesday' => 'Dienstag',
        'Wednesday' => 'Mittwoch',
        'Thursday' => 'Donnerstag',
        'Friday' => 'Freitag',
        'Saturday' => 'Samstag',
    ];

    $currentDayOfWeek = $currentDayOfWeekAsStringInGerman[now()->format('l')];

    /*
     |--------------------------------------------------------------------------
     | ✅ Worked hours FOR SELECTED MONTH
     |--------------------------------------------------------------------------
     */
    $workedHours = WorkLog::where('user_id', $currentUser->id)
        ->whereNotNull('clock_out')
        ->whereBetween('clock_in', [$startOfMonth, $endOfMonth])
        ->get()
        ->sum(function ($log) {
            $clockIn  = Carbon::parse($log->clock_in);
            $clockOut = Carbon::parse($log->clock_out);

            return $clockOut->diffInMinutes($clockIn) / 60;
        });

    /*
     |--------------------------------------------------------------------------
     | Worklogs for selected month
     |--------------------------------------------------------------------------
     */
    $worklogs = WorkLog::where('user_id', $currentUser->id)
        ->whereBetween('clock_in', [$startOfMonth, $endOfMonth])
        ->get();

    /*
     |--------------------------------------------------------------------------
     | Break durations
     |--------------------------------------------------------------------------
     */
    $breakDurations = [];

    foreach ($worklogs as $log) {
        $totalBreakMinutes = WorkBreak::where('work_log_id', $log->id)
            ->whereNotNull('start_time')
            ->whereNotNull('end_time')
            ->get()
            ->sum(function ($break) {
                return Carbon::parse($break->start_time)
                    ->diffInMinutes(Carbon::parse($break->end_time));
            });

        // ✅ force integer minutes
        $breakDurations[$log->id] = (int) $totalBreakMinutes;
    }

    return view('users.dashboard', compact(
        'usersCount',
        'activeUsers',
        'workedHours',
        'currentDayOfWeek',
        'worklogs',
        'breakDurations',
        'year',
        'month'
    ));
}

}
