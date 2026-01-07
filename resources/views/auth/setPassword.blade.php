@extends('master.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Card wrapper -->
            <div class="card shadow-sm">
                <div class="card-header text-center" style="background-color: #005461; color: #F4F4F4;">
                    <h4 class="mb-0">Set Your Password</h4>
                </div>

                <div class="card-body" style="background-color: #F4F4F4;">
                    <!-- Error messages -->
                    @if ($errors->any())
                        <div class="alert" style="background-color: #018790; color: #F4F4F4;">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Password form -->
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">

                        <div class="mb-3">
                            <label class="form-label" style="color: #3B4953;">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="color: #3B4953;">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn w-100" style="background-color: #90AB8B; color: #F4F4F4;">
                            Set Password
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
