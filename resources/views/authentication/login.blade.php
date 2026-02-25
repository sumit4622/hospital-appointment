@extends('authentication.layout')

@section('content')

    <body class="d-flex align-items-center justify-content-center vh-100 bg-light flex-column m-0">

        <div class="card shadow-lg p-4 text-center" style="width: 500px; border-radius: 15px;">

            
            <h2 class="text-center text-success mb-3">Log-In </h2>

            <form>

                <div class="mb-3 text-start">
                    <label for="first" class="form-label fw-bold text-secondary">
                        Email:
                    </label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter your Username"
                        required>
                </div>

                <div class="mb-3 text-start">
                    <label for="password" class="form-label fw-bold text-secondary">
                        Password:
                    </label>
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Enter your Password" required>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success w-100 py-2 rounded-3">
                        Submit
                    </button>
                </div>

            </form>

            <p class="mt-3">
                Not registered?
                <a href="{{route('user.register')}}" class="text-decoration-none">
                    Create an account
                </a>
            </p>

        </div>

    </body>
@endsection
