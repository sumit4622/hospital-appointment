@extends('authentication.layout')

@section('content')

    <body class="d-flex align-items-center justify-content-center vh-100 bg-light">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-lg p-4 rounded-4" style="width: 500px;">

            <h2 class="text-center text-success mb-3">Create Account</h2>

            <form action="{{ route('user.register.store') }}"method="POST">
                @csrf
                @method('POST')

                <div class="mb-3 row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-secondary">First Name</label>
                        <input type="text" name="first_name" value="{{old('first_name')}}"class="form-control" placeholder="Ram" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-secondary">last Name</label>
                        <input type="text" name="last_name" value="{{old('last_name')}}"class="form-control" placeholder="Nepal" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-secondary">Gender</label>
                        <select name="gender"  value="{{old('gender')}}"class="form-select" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control" placeholder='9841234578'
                                required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-secondary">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Username</label>
                            <input type="text" name="username" value="{{old('username')}}" class="form-control" placeholder='Ram123' required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary">Email</label>
                    <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter your Username" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your Password" required>
                </div>


                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Re-enter your Password" required>
                </div>

                <button type="submit" class="btn btn-success w-100 py-2 rounded-3">
                    Register
                </button>

            </form>

            <p class="text-center mt-3">
                Already have an account?
                <a href="{{ route('login') }}" class="text-decoration-none">
                    Login here
                </a>
            </p>

        </div>

    </body>
@endsection
