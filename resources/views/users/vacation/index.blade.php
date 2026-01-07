@extends('master.app')
@section('content')
<div class="container mt-5">
    <h3>Urlaub</h3>
    <p>Verbleibende Tage: {{ $remainingDays }}</p>
    <a href="{{ route('users.vacation.create') }}" class="btn btn-primary mb-3">Neuen Urlaub beantragen</a>

    <table class="table">
        <thead>
            <tr>
                <th>Start</th>
                <th>Ende</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vacations as $vacation)
                <tr>
                    <td>{{ $vacation->start_date }}</td>
                    <td>{{ $vacation->end_date }}</td>
                    <td>{{ ucfirst($vacation->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Keine Urlaube beantragt</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
