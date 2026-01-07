@extends('master.app')
@section('content')
<div class="container mt-4">
    <!-- Dashboard Cards -->
    <div class="row mb-4 g-3 text-center">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header" style="background-color: #005461; color: #F4F4F4; font-weight: bold;">
                    Benutzer
                </div>
                <div class="card-body" style="background-color: #F4F4F4; color: #005461; font-size: 1.2rem;">
                    {{ $usersCount }}
                </div>
                <div class="card-footer" style="background-color: #018790; color: #F4F4F4;">
                    Aktive Benutzer: {{ $activeUsers }}
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header" style="background-color: #005461; color: #F4F4F4; font-weight: bold;">
                    Heute
                </div>
                <div class="card-body" style="background-color: #F4F4F4; color: #005461; font-size: 1.2rem;">
                    {{ $currentDayOfWeek }}
                </div>
                <div class="card-footer" style="background-color: #018790; color: #F4F4F4;">
                    <div id="txt"></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header" style="background-color: #005461; color: #F4F4F4; font-weight: bold;">
                    Gearbeitete Stunden
                </div>
                <div class="card-body" style="background-color: #F4F4F4; color: #005461; font-size: 1.2rem;">
                    {{ $workedHours }}/160
                </div>
                <div class="card-footer" style="background-color: #018790; color: #F4F4F4;">
                    {{ \Carbon\Carbon::create($year, $month)->locale('de')->isoFormat('MMMM YYYY') }}
                </div>
            </div>
        </div>
    </div>

        <!-- Month Navigation -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        @php
            $year = request()->get('year', now()->year);
            $month = request()->get('month', now()->month);
            $prev = \Carbon\Carbon::createFromDate($year, $month, 1)->subMonth();
            $next = \Carbon\Carbon::createFromDate($year, $month, 1)->addMonth();
            $monthName = \Carbon\Carbon::createFromDate($year, $month, 1)->locale('de')->isoFormat('MMMM YYYY');
        @endphp
        <a href="{{ route('users.dashboard', ['month' => $prev->month, 'year' => $prev->year]) }}" class="btn" style="background-color:#018790; color:#F4F4F4;">&laquo; Vorheriger Monat</a>
        <h4 style="color:#005461; font-weight:bold;">{{ ucfirst($monthName) }}</h4>
        <a href="{{ route('users.dashboard', ['month' => $next->month, 'year' => $next->year]) }}" class="btn" style="background-color:#018790; color:#F4F4F4;">Nächster Monat &raquo;</a>
    </div>


    <!-- Worklog Table -->
    <div class="card shadow-sm">
        <div class="card-header" style="background-color: #005461; color: #F4F4F4; font-weight: bold;">
            Arbeitszeiten
        </div>
        <div class="card-body p-0" style="background-color: #F4F4F4;">
            <table class="table table-striped mb-0">
                <thead style="background-color: #018790; color: #F4F4F4;">
                    <tr>
                        <th>Wochentag</th>
                        <th>Tag</th>
                        <th>Startzeit</th>
                        <th>Endzeit</th>
                        <th>Pause</th>
                    </tr>
                </thead>
               <tbody>
                    @php
                        $daysInMonth = \Carbon\Carbon::create($year, $month, 1)->daysInMonth;
                    @endphp

                    @for($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $dateObj = \Carbon\Carbon::create($year, $month, $day);
                            $date = $dateObj->format('Y-m-d');
                            $weekday = ucfirst($dateObj->locale('de')->isoFormat('dddd'));
                            $logsForDay = $worklogs->filter(
                                fn($log) => \Carbon\Carbon::parse($log->clock_in)->format('Y-m-d') === $date
                            );
                        @endphp

                        @if($logsForDay->count())
                            @foreach($logsForDay as $log)
                                <tr style="color:#005461;">
                                    <td>{{ $weekday }}</td>
                                    <td>{{ $dateObj->format('d.m.Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($log->clock_in)->format('H:i') }}</td>
                                    <td>
                                        @if($log->clock_out)
                                            {{ \Carbon\Carbon::parse($log->clock_out)->format('H:i') }}
                                        @else
                                            Noch nicht ausgestempelt
                                        @endif
                                    </td>
                                    <td>{{ $breakDurations[$log->id] ?? 0 }} Min</td>
                                </tr>
                            @endforeach
                        @else
                            <tr style="color:#005461; opacity:0.7;">
                                <td>{{ $weekday }}</td>
                                <td>{{ $dateObj->format('d.m.Y') }}</td>
                                <td colspan="3" class="text-center">Keine Arbeitszeit gestochen</td>
                            </tr>
                        @endif
                    @endfor
                    </tbody>

            </table>
        </div>
    </div>

</div>

<script>
    function startTime() {
        const today = new Date();
        let h = today.getHours();
        let m = today.getMinutes();
        let s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('txt').innerHTML = h + ":" + m + ":" + s;
        setTimeout(startTime, 500);
    }
    function checkTime(i) {
        return i < 10 ? "0" + i : i;
    }
    startTime();
</script>
@endsection
