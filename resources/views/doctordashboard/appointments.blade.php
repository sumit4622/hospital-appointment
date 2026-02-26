@extends('doctordashboard.layout')

@section('doctorcontent')

<div class="card shadow-sm p-4">
    <h4 class="text-success">Today's Appointments</h4>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Patient</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>John Doe</td>
                <td>2026-03-01</td>
                <td><span class="badge bg-success">Confirmed</span></td>
            </tr>
        </tbody>
    </table>
</div>

@endsection