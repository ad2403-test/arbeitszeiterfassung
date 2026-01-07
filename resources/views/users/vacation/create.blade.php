@extends('master.app')
@section('content')
<div class="container mt-5">
    <h3>Urlaub beantragen</h3>

    <form method="POST" action="{{ route('users.vacation.store') }}">
        @csrf
        <div class="mb-3">
            <label>Startdatum</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Enddatum</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Beantragen</button>
    </form>
</div>
@endsection
