@extends('admindashboard.layout')

@section('admincontent')
    
    <div class="container mt-4">
        <div class="row g-4 mb-4">

            <div class="col-6 col-md-4">
                <a href="{{ route('admin.dashboard.user')}}" class="btn btn-primary w-100 py-4 shadow-sm d-flex flex-column align-items-center">
                    <i class="fas fa-users mb-2 fs-3"></i>
                    <span class="fw-bold text-uppercase">Users</span>
                </a>
            </div>

            <div class="col-6 col-md-4">
                <a href="#" class="btn btn-primary w-100 py-4 shadow-sm d-flex flex-column align-items-center">
                    <i class="fas fa-hospital mb-2 fs-3"></i>
                    <span class="fw-bold text-uppercase">Department</span>
                </a>
            </div>

            <div class="col-6 col-md-4">
                <a href="{{ route('admin.dashboard.doctor')}}" class="btn btn-primary w-100 py-4 shadow-sm d-flex flex-column align-items-center">
                    <i class="fas fa-user-md mb-2 fs-3"></i>
                    <span class="fw-bold text-uppercase">Doctor</span>
                </a>
            </div>

            <div class="col-6 col-md-4">
                <a href="#" class="btn btn-primary w-100 py-4 shadow-sm d-flex flex-column align-items-center">
                    <i class="fas fa-calendar-check mb-2 fs-3"></i>
                    <span class="fw-bold text-uppercase">Appointment</span>
                </a>
            </div>

        </div>
    </div>
@endsection
