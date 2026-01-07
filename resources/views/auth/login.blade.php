@extends('master.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <!-- Card wrapper -->
            <div class="card shadow-sm">
                
                <!-- Card header -->
                <div class="card-header text-center" style="background-color: #005461; color: #F4F4F4;">
                    <h4 class="mb-0">Anmeldung</h4>
                </div>

                <!-- Card body -->
                <div class="card-body" style="background-color: #F4F4F4;">

                    <!-- Display errors -->
                    @if($errors->any())
                        <div class="alert" style="background-color: #018790; color: #F4F4F4;">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Login form -->
                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label" style="color: #005461;">Email Adresse</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label" style="color: #005461;">Passwort</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        </div>

                        <button type="submit" class="btn w-100" style="background-color: #018790; color: #F4F4F4;">
                            Anmelden
                        </button>
                    </form>

                </div>


            </div>

        </div>
    </div>
</div>
@endsection
