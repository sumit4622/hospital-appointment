@extends('authentication.layout')

@section('content')

    <body class="d-flex align-items-center justify-content-center vh-100 bg-light">

        <div class="card shadow-lg p-4 rounded-4" style="width: 500px;">

            <h2 class="text-center text-success mb-3">Create Account</h2>

            <form method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary">Full Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-secondary">Gender</label>
                        <select name="gender" class="form-select" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-secondary">Register As</label>
                        <select name="role" class="form-select" required>
                            <option value="user">Patient</option>
                            <option value="doctor">Doctor</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success w-100 py-2 rounded-3">
                    Register
                </button>

            </form>

            <p class="text-center mt-3">
                Already have an account?
                <a href="{{ route('user.login') }}" class="text-decoration-none text-success">
                    Login here
                </a>
            </p>

        </div>

    </body>
@endsection
