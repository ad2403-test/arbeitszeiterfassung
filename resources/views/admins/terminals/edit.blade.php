@extends('master.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header text-center" style="background-color: #005461; color: #F4F4F4;">
                    <h4 class="mb-0">Edit Terminal</h4>
                </div>

                <div class="card-body" style="background-color: #F4F4F4;">
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

                    <form method="POST" action="{{ route('terminals.update', $terminal->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label" style="color: #005461;">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $terminal->name }}" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn" style="background-color: #018790; color: #F4F4F4;">
                                <i class="fa fa-save"></i> Update
                            </button>
                            <a href="{{ route('terminals.index') }}" class="btn" style="background-color: #00B7B5; color: #F4F4F4;">
                                Cancel
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
