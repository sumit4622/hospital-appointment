@extends('patientdashboard.layout')

@section('patientcontent')

<section class="bg-light py-5">
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-8">
            <a class="btn btn-primary" href="{{route('patient.dashboard')}}"> Back </a>

                <div class="card shadow-sm text-center p-4 mb-4">
                
                    <img src="https://cdn-icons-png.flaticon.com/512/387/387561.png"
                        alt="avatar"
                        class="rounded-circle img-fluid mx-auto"
                        style="width: 150px;">

                    <h5 class="mt-3 mb-1">Username : {{ $doctor->username }}</h5>
                    <p class="text-muted">Doctor</p>
                </div>


                <div class="card shadow-sm mb-4 p-4">
                    <h5 class="text-success mb-3">Profile Information</h5>

                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">Full Name</div>
                        <div class="col-sm-8 text-muted">
                            {{ $doctor->full_name }}
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">Email</div>
                        <div class="col-sm-8 text-muted">
                            {{ $doctor->email }}
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">Phone</div>
                        <div class="col-sm-8 text-muted">
                            {{ $doctor->phone_number ?? 'N/A' }}
                        </div>
                    </div>
                </div>


                <div class="card shadow-sm p-4">
                    <h5 class="text-success mb-3">Book Appointment</h5>

                    <form method="POST" action="#">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Select Doctor</label>
                            <select name="doctor_id" class="form-select" required>
                                <option value="">Select Doctor</option>
                                <option value="1">Dr. Smith - Cardiologist</option>
                                <option value="2">Dr. John - Dermatologist</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Select Date</label>
                                <input type="date" name="appointment_date" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Select Time</label>
                                <input type="time" name="appointment_time" class="form-control" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Book Now
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection