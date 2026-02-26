@extends('patientdashboard.layout')

@section('patientcontent')

<div class="card shadow-sm p-4">
    <h3 class="text-success">Welcome {{ Auth::user()->full_name }}</h3>
    <p class="lead">Book and manage your appointments easily.</p>
</div>

@endsection