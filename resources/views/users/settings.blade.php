@extends('master.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header text-center"
                     style="background-color:#005461; color:#F4F4F4;">
                    <h5 class="mb-0">Meine Einstellungen</h5>
                </div>

                <div class="card-body" style="background-color:#F4F4F4;">

                    {{-- Success message --}}
                    @if(session('success'))
                        <div class="alert"
                             style="background-color:#00B7B5; color:#005461;">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('users.settings.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label" style="color:#005461;">
                                Vorname
                            </label>
                            <input type="text"
                                   class="form-control"
                                   name="first_name"
                                   value="{{ $user->first_name }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="color:#005461;">
                                Nachname
                            </label>
                            <input type="text"
                                   class="form-control"
                                   name="last_name"
                                   value="{{ $user->last_name }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="color:#005461;">
                                E-Mail
                            </label>
                            <input type="email"
                                   class="form-control"
                                   name="email"
                                   value="{{ $user->email }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="color:#005461;">
                                RFID UID
                            </label>
                            <input type="text"
                                   class="form-control"
                                   name="rfid_uid"
                                   value="{{ $user->rfid_uid }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="color:#005461;">
                                Zwei-Faktor-Authentifizierung
                            </label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="enable_2fa" id="enable2fa"
                                    {{ $user->two_factor_enabled ? 'checked' : '' }}>
                                <label class="form-check-label" for="enable2fa">Aktivieren</label>
                            </div>

                            @if($user->two_factor_enabled && $qrCodeSvg)
                                <div class="mt-3">
                                    <p>Scanne diesen QR Code in deiner Authenticator-App:</p>
                                    <div>{!! $qrCodeSvg !!}</div>
                                </div>
                            @endif

                        </div>

                        <div class="d-grid">
                            <button type="submit"
                                    class="btn"
                                    style="background-color:#018790; color:#F4F4F4;">
                                <i class="fa fa-save"></i> Speichern
                            </button>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection
