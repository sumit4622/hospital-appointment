@extends('patientdashboard.layout')

@section('patientcontent')

<div class="card shadow-sm p-4">
    <h4 class="text-success">My Appointments</h4>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Doctor</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Dr. Smith</td>
                <td>2026-03-01</td>
                <td><span class="badge bg-warning">Pending</span></td>
            </tr>
        </tbody>
    </table>
</div>

@endsection