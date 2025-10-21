@extends('master.app')
@section('content')
    <div class="card" style="margin-top: 200px; margin-left: 300px; margin-right:300px">
        <div class="card-header text-center">
            Anmeldung
        </div>
        <form action="{{ route('auth.login') }}" method="POST">
            <div class="card-body">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email Adresse</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Passwort</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
            </div>
            <div class="card-footer text-body-secondary d-grid gap-2">
                <button type="submit" class="btn btn-primary">Anmelden</button>
            </div>
        </form>
    </div>
@endsection