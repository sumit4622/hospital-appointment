@extends('authentication.layout')

@section('content')
<div class="container mt-5">
    <div class="card p-5 shadow">
        <h1>Welcome, {{ Auth::user()->full_name }}!</h1>
        <p class="lead">You are logged in as a <strong>{{ ucfirst(Auth::user()->role) }}</strong>.</p>
        
        <hr>

        @if(Auth::user()->role == 'doctor')
            <div class="alert alert-info">
                <h4>Doctor Menu</h4>
                <ul>
                    <li>View Today's Appointments</li>
                    <li>Patient Records</li>
                </ul>
            </div>
        @else
            <div class="alert alert-success">
                <h4>Patient Menu</h4>
                <ul>
                    <li>Book an Appointment</li>
                    <li>My Medical History</li>
                </ul>
            </div>
        @endif

        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
</div>
@endsection