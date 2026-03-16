@extends('admindashboard.layout')

@section('admincontent')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Appointment List</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Doctor Name</th>
                                <th>Contact</th>
                                {{-- <th>Status</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($value as $index => $val)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($val->appointment_date)->format('M d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($val->appointment_time)->format('h:i A') }}</td>
                                    <td>
                                        @if (request()->route('id') == $val->patient_id)
                                            <div class="fw-bold">Dr. {{ $val->doctor->full_name ?? 'N/A' }}</div>
                                            <small class="badge bg-info text-dark">Doctor</small>
                                        @else
                                            <div class="fw-bold">{{ $val->patient->full_name ?? 'N/A' }}</div>
                                            <small class="badge bg-secondary">Patient</small>
                                        @endif
                                    </td>
                                    <td>{{ $val->doctor->phone_number ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">No appointments found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
