@extends('layout')

@section('content')
    <div class="container-fluid vh-100 d-flex flex-column p-0 overflow-hidden">

        <header class="row g-0 align-items-center bg-success text-white px-4" style="height: 10%; min-height: 60px;">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Doctor Dashboard</h5>

                <ul class="nav">
                    <li class="nav-item">
                        <a href="{{ route('doctor.dashboard') }}" class="nav-link text-white fw-bold">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white">Patient Records</a>
                    </li>
                </ul>

                <form action="{{route('logout')}}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        </header>

        <div class="row g-0 flex-grow-1" style="height: 90%;">

            <aside class="col-md-3 col-lg-2 bg-light border-end p-4 d-flex flex-column">
                <div class="text-center mb-4">
                    <h6 class="text-success fw-bold mb-0">
                        Dr. {{ Auth::user()->full_name }}
                    </h6>
                    <small class="text-muted">Medical Practitioner {{Auth::user()->role}}</small>
                </div>

                <hr>

                <nav class="nav flex-column">
                    <a class="nav-link text-dark active" href="#"><i class="bi bi-house-door me-2"></i> Home</a>
                    <a class="nav-link text-dark" href="#"><i class="bi bi-person me-2"></i> Profile</a>
                    <a class="nav-link text-dark" href="#"><i class="bi bi-gear me-2"></i> Settings</a>
                </nav>

                <div class="mt-auto">
                    <p class="text-muted x-small text-center">Hospital System v1.0</p>
                </div>
            </aside>

            <main class="col-md-9 col-lg-10 p-5 bg-white overflow-auto">
                @yield('doctorcontent')
            </main>

        </div>
    </div>
@endsection