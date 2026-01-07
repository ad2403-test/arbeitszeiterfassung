@extends('master.app')

@section('content')
<div class="container mt-5">

    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col">
            <h2 style="color: #005461;">Terminals</h2>
        </div>
        <div class="col text-end">
            <a href="{{ route('terminals.create') }}" class="btn" style="background-color: #018790; color: #F4F4F4;">
                <i class="fa fa-plus"></i> Add Terminal
            </a>
        </div>
    </div>

    <!-- Terminals Table -->
    <div class="row">
        <div class="col">
            <div class="card" style="background-color: #F4F4F4;">
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0">
                        <thead style="background-color: #005461; color: #F4F4F4;">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>API Token</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($terminals as $terminal)
                                <tr style="color: #005461;">
                                    <td>{{ $terminal->id }}</td>
                                    <td>{{ $terminal->name }}</td>
                                    <td>{{ $terminal->api_token }}</td>
                                    <td>{{ $terminal->created_at }}</td>
                                    <td>{{ $terminal->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('terminals.edit', $terminal->id) }}" class="btn btn-sm" style="background-color: #018790; color: #F4F4F4;">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('terminals.destroy', $terminal->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm" style="background-color: #00B7B5; color: #F4F4F4;" onclick="return confirm('Are you sure you want to delete this terminal?');">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center" style="color: #005461;">No terminals found.</td>
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
