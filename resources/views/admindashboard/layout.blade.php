@extends('layout')

@section('content')
    <div class="container-fluid vh-100 d-flex flex-column p-0 overflow-hidden">

        <header class="row g-0 align-items-center bg-success text-white px-4" style="height: 10%; min-height: 60px;">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Admin Dashboard</h5>

                <ul class="nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white fw-bold">Dashboard</a>
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

            <main class="p-3">
                @yield('admincontent')
            </main>

        </div>
    </div>
@endsection