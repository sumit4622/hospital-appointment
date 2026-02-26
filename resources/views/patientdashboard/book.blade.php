@extends('patientdashboard.layout')

@section('patientcontent')

<div class="card shadow-sm p-4">
    <h4 class="text-success">Book Appointment</h4>

    <form>
        <div class="mb-3">
            <label class="form-label">Select Doctor</label>
            <select class="form-select">
                <option>Dr. Smith - Cardiologist</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Select Date</label>
            <input type="date" class="form-control">
        </div>

        <button class="btn btn-success">Book Now</button>
    </form>

</div>

@endsection