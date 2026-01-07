<?php

namespace App\Exports;

use App\Models\WorkLog;
use App\Models\WorkBreak;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class UserWorklogsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $user;
    protected $month;
    protected $year;
    protected $worklogs;

    public function __construct($user, $month, $year)
    {
        $this->user  = $user;
        $this->month = $month;
        $this->year  = $year;

        // Preload all worklogs for the month
        $start = Carbon::create($this->year, $this->month, 1)->startOfMonth();
        $end   = Carbon::create($this->year, $this->month, 1)->endOfMonth();

        $this->worklogs = WorkLog::where('user_id', $this->user->id)
            ->whereBetween('clock_in', [$start, $end])
            ->get()
            ->keyBy(function($log) {
                return Carbon::parse($log->clock_in)->format('Y-m-d');
            });
    }

    public function collection()
    {
        $daysInMonth = Carbon::create($this->year, $this->month, 1)->daysInMonth;
        $collection = new Collection();

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dateObj = Carbon::create($this->year, $this->month, $day);
            $dateStr = $dateObj->format('Y-m-d');
            $weekday = ucfirst($dateObj->locale('de')->isoFormat('dddd'));

            $log = $this->worklogs->get($dateStr);

            $clockIn = $log ? Carbon::parse($log->clock_in)->format('H:i') : null;
            $clockOut = $log && $log->clock_out ? Carbon::parse($log->clock_out)->format('H:i') : null;

            // Break duration
            $totalBreakMinutes = 0;
            if ($log) {
                $breaks = WorkBreak::where('work_log_id', $log->id)
                    ->whereNotNull('start_time')
                    ->whereNotNull('end_time')
                    ->get();

                foreach ($breaks as $break) {
                    $totalBreakMinutes += Carbon::parse($break->end_time)
                        ->diffInMinutes(Carbon::parse($break->start_time));
                }
            }

            // Worked hours minus breaks
            $workedHours = 0;
            if ($log && $log->clock_out) {
                $workedMinutes = Carbon::parse($log->clock_out)
                    ->diffInMinutes(Carbon::parse($log->clock_in)) - $totalBreakMinutes;
                $workedHours = round($workedMinutes / 60);
            }

            $collection->push([
                'date'      => $dateObj->format('d.m.Y'),
                'weekday'   => $weekday,
                'clock_in'  => $clockIn ?? '-',
                'clock_out' => $clockOut ?? '-',
                'break'     => $totalBreakMinutes,
                'worked'    => $workedHours,
            ]);
        }

        return $collection;
    }

    public function headings(): array
    {
        return ['Date', 'Weekday', 'Clock In', 'Clock Out', 'Break (min)', 'Worked Hours'];
    }

    public function map($row): array
    {
        return [
            $row['date'],
            $row['weekday'],
            $row['clock_in'],
            $row['clock_out'],
            $row['break'],
            $row['worked'],
        ];
    }
}
