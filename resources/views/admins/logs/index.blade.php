@extends('master.app')
@section('content')
<div class="container mt-4">
    <h2>Activity Logs</h2>
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead style="background-color: #005461; color: #F4F4F4;">
                    <tr>
                        <th>User</th>
                        <th>Action</th>
                        <th>Details</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr style="color: #005461;">
                        <td>{{ $log->user?->first_name }} {{ $log->user?->last_name ?? 'System' }}</td>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->details }}</td>
                        <td>{{ $log->created_at->format('d.m.Y H:i:s') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
