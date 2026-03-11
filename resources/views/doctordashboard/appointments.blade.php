@extends('doctordashboard.layout')

@section('doctorcontent')
    <div class="card shadow-sm p-4">
        <h4 class="text-success">Appointments list</h4>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Patient Name</th>
                    <th>Appointment date</th>
                    <th>Appointment time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $index => $appointment)
                    <tr>

                        <td>{{ $index + 1 }}</td>

                        <td>{{ $appointment->patient->full_name ?? 'N/A' }}</td>

                        <td>{{ $appointment->appointment_date }}</td>

                        <td>{{ $appointment->appointment_time }}</td>

                        {{-- <td>
                            <a class="btn btn-primary">Complete</a>
                            <a class="btn btn-danger">Delete</a>
                            <a class="btn btn-warning">View Profile</a>
                        </td> --}}

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
