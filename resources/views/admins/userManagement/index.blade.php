@extends('master.app')
@section('content')
<div class="container mt-5">

    <!-- Page header -->
    <div class="row mb-3">
        <div class="col">
            <h2 style="color: #005461;">Benutzerverwaltung</h2>
        </div>
    </div>

    <!-- Search and add button -->
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Suche..." aria-label="Search">
                <button class="btn" style="background-color: #018790; color: #F4F4F4;" type="button">
                    <i class="fa fa-search"></i>
                </button>
                <button class="btn" style="background-color: #005461; color: #F4F4F4;" type="button">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
        <div class="col text-end">
            <a href="{{ route('admin.user.management.create') }}" class="btn" style="background-color: #018790; color: #F4F4F4;">
                <i class="fa fa-plus"></i> Add User
            </a>
        </div>
    </div>

    <!-- User table -->
    <div class="row">
        <div class="col">
            <div class="card" style="background-color: #F4F4F4;">
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0">
                        <thead style="background-color: #005461; color: #F4F4F4;">
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr style="color: #005461;">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td class="d-flex gap-1">
                                        <a href="{{ route('admin.user.management.edit', $user->id) }}" class="btn btn-sm" style="background-color: #018790; color: #F4F4F4;">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.user.management.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm" style="background-color: #005461; color: #F4F4F4;" onclick="return confirm('Are you sure you want to delete this user?');">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        <a
                                            href="{{ route('users.dashboard.export', [
                                                'user' => $user->id,
                                                'month' => request('month', now()->month),
                                                'year'  => request('year', now()->year),
                                            ]) }}"
                                            class="btn btn-sm"
                                            style="background-color:#00B7B5; color:#005461;"
                                            title="Export work logs (current month)"
                                        >
                                            <i class="fa fa-file-excel-o"></i>
                                        </a>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center" style="color: #005461;">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
