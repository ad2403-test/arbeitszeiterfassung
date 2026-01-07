@extends('master.app')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Card wrapper -->
            <div class="card shadow-sm" style="background-color: #F4F4F4;">
                <div class="card-header text-center" style="background-color: #005461; color: #F4F4F4;">
                    <h4 class="mb-0">Edit User</h4>
                </div>

                <div class="card-body">
                    <!-- Success / error messages -->
                    @if(session('success'))
                        <div class="alert" style="background-color: #018790; color: #F4F4F4;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Update form -->
                    <form method="POST" action="{{ route('admin.user.management.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label" style="color: #005461;">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="color: #005461;">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="color: #005461;">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="color: #005461;">RFID UID</label>
                            <input type="text" class="form-control" name="rfid_uid" value="{{ $user->rfid_uid ?? '' }}">
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="role" value="admin" {{ $user->role === 'admin' ? 'checked' : '' }}>
                            <label class="form-check-label" style="color: #005461;">Admin</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn" style="background-color: #018790; color: #F4F4F4;">
                                <i class="fa fa-save"></i> Update
                            </button>
                            <a href="{{ route('admin.user.management') }}" class="btn" style="background-color: #005461; color: #F4F4F4;">
                                <i class="fa fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>

                    <!-- Password setup link -->
                    <hr>
                    <form action="{{ route('admin.user.management.sendPasswordLink', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn w-100 mt-2" style="background-color: #018790; color: #F4F4F4;">
                            <i class="fa fa-envelope"></i> Send Password Setup Link
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
