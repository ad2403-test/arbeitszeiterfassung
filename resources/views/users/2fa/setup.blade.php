@extends('master.app')

@section('content')
<div class="container mt-5 text-center">
    <h3 style="color:#005461;">Enable Two-Factor Authentication</h3>

    <p>Scan this QR code with Google Authenticator or Authy.</p>

    <img src="{{ $qrCodeUrl }}" alt="QR Code">

    <form method="POST" action="{{ route('2fa.enable') }}" class="mt-4">
        @csrf
        <input class="form-control text-center mb-3"
               name="one_time_password"
               placeholder="123456"
               required>

        <button class="btn" style="background:#018790;color:#F4F4F4;">
            Enable 2FA
        </button>
    </form>
</div>
@endsection
