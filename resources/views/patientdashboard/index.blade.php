@extends('patientdashboard.layout')

@section('patientcontent')
    <div class="container mt-5">
        <div class="input-group mb-3" style="max-width: 600px;">
            <div class="input-group mb-3 shadow-sm" style="border-radius: 8px; overflow: hidden;">

                <div class="form-outline flex-grow-1" data-mdb-input-init>
                    <input type="search" id="doctorSpecSearch" class="form-control form-control-lg" list="specializationList"
                        placeholder="search here...." />
                </div>
                <datalist id="specializationList">
                    @foreach ($specializations as $specialization)
                        <option
                            value="{{ optional($specialization->doctorprofile)->specialization ?? 'general medicine' }}">
                        </option>
                    @endforeach
                </datalist>

            </div>
        </div>
        <div class="row g-4">
            @foreach ($doctors as $doctor)
                <div class="col-md-6 col-xl-4 doctor-card"
                    data-specialization="{{ strtolower(optional($doctor->doctorprofile)->specialization ?? 'general medicine') }}"
                    >
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


<script>
    document.addEventListener("DOMContentLoaded", function() {

        const searchInput = document.getElementById("doctorSpecSearch");
        const doctorCards = document.querySelectorAll(".doctor-card");

        if (!searchInput) return;

        searchInput.addEventListener("input", function() {

            const filter = this.value.toLowerCase();

            doctorCards.forEach(card => {

                const specialization = card.dataset.specialization;

                if (specialization.includes(filter)) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }

            });

        });

    });
</script>
