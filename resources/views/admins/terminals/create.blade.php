@extends('master.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header text-center" style="background-color: #005461; color: #F4F4F4;">
                    <h4 class="mb-0">Add Terminal</h4>
                </div>

                <div class="card-body" style="background-color: #F4F4F4;">
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

                    <!-- Terminal form -->
                    <form method="POST" action="{{ route('terminals.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" style="color: #005461;">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <button type="submit" class="btn w-100" style="background-color: #018790; color: #F4F4F4;">
                            <i class="fa fa-plus"></i> Add Terminal
                        </button>
                        <a href="{{ route('terminals.index') }}" class="btn w-100 mt-2" style="background-color: #00B7B5; color: #F4F4F4;">
                            Cancel
                        </a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
