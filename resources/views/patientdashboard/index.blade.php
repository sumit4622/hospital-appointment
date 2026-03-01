@extends('patientdashboard.layout')

@section('patientcontent')
    <div class="container py-5">
        <div class="row g-4">
            @foreach ($doctors as $doctor)
                <div class="col-md-6 col-xl-4">
                    <div class="card shadow" style="border-radius: 15px;">
                        <div class="card-body text-center">
                            <div class="mt-3 mb-4">
                                <img src="https://cdn-icons-png.flaticon.com/512/387/387561.png"
                                    class="rounded-circle img-fluid" style="width: 100px;" />
                            </div>

                            <h4 class="mb-2">DR. {{ $doctor->full_name }}</h4>

                            <p class="text-muted mb-4">
                                {{ $doctor->doctorprofile->specialization ?? 'General Medicine' }} |
                                <a href="#!">{{ $doctor->email }}</a>
                            </p>

                            <a href="{{ route('patient.doctor.book', ['doctorid' => $doctor->id]) }}"
                                class="btn btn-primary btn-rounded btn-lg">
                                Book Appointment
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
