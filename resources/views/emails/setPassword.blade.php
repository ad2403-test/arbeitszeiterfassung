@extends('layouts.email')

@section('content')
    <p>Hello <strong>{{ $user->first_name }}</strong>,</p>

    <p>
        An account has been created for you.
        To get started, please set your password by clicking the button below.
    </p>

    <p style="text-align:center; margin:30px 0;">
        <a href="{{ $resetUrl }}"
           style="
                display:inline-block;
                padding:12px 24px;
                background:#198754;
                color:#ffffff;
                text-decoration:none;
                border-radius:5px;
                font-weight:bold;
           ">
            Set Password
        </a>
    </p>

    <p>
        This link is valid for a limited time.
        If you did not expect this email, you can safely ignore it.
    </p>

    <p>
        Best regards,<br>
        <strong>{{ config('app.name') }} Team</strong>
    </p>
@endsection
