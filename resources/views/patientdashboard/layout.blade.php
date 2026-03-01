@extends('layout')

@section('content')
    <div class="d-flex flex-column ">

        <header class="bg-success text-white px-4 py-3 d-flex justify-content-between align-items-center shadow-sm">
            <h5 class="mb-0">Patient Dashboard</h5>

            <ul class="nav">
                <li class="nav-item">
                    <a href="{{ route('patient.dashboard') }}" class="nav-link text-white fw-bold">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">Book Appointment</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">My Appointments</a>
                </li>
            </ul>

            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button class="btn btn-light btn-sm">Logout</button>
            </form>
        </header>

        <div class="row g-0 flex-grow-1" style="height: 90%;">

            <main class="p-3">
                @yield('patientcontent')
            </main>

        </div>

    </div>
@endsection
