@extends('patientdashboard.layout')

@section('patientcontent')
<div class="container mt-4">
    <h4 class="mb-4">My Medical Appointments</h4>
    
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>Doctor Name</th>
                        <th>Specialization</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointment as $appoiment)
                        <tr>
                            <td class="fw-bold">Dr. {{ $appoiment->doctor->full_name }}</td>
                            <td>{{ $appoiment->doctor?->doctorprofile?->specialization ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($appoiment->appointment_date)->format('M d, Y') }}</td>
                            <td>
                                <span class="badge bg-outline-primary text-primary border border-primary">
                                    {{ \Carbon\Carbon::parse($appoiment->appointment_time)->format('h:i A') }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">You have no scheduled appointments.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection