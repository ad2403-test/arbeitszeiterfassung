@extends('master.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header text-center" style="background-color:#005461; color:#F4F4F4;">
                    <h5>Two-Factor Authentication</h5>
                </div>
                <div class="card-body" style="background-color:#F4F4F4;">
                    <form method="POST" action="{{ route('2fa.verify') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="otp" class="form-label">Enter your 6-digit code:</label>
                            <input type="text" name="one_time_password" id="otp" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn" style="background-color:#018790; color:#F4F4F4;">
                                Verify
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
