@extends('master.app')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Card wrapper -->
            <div class="card shadow-sm" style="background-color: #F4F4F4;">
                <div class="card-header text-center" style="background-color: #005461; color: #F4F4F4;">
                    <h4 class="mb-0">Create New User</h4>
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

                    <!-- Create user form -->
                    <form method="POST" action="{{ route('admin.user.management.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" style="color: #005461;">First Name</label>
                            <input type="text" class="form-control" name="first_name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="color: #005461;">Last Name</label>
                            <input type="text" class="form-control" name="last_name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="color: #005461;">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="role" value="admin">
                            <label class="form-check-label" style="color: #005461;">
                                Admin user
                            </label>
                        </div>

                        <button type="submit" class="btn w-100" style="background-color: #018790; color: #F4F4F4;">
                            <i class="fa fa-envelope"></i> Create user & send email
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
