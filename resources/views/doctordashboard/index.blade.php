@extends('doctordashboard.layout')

@section('doctorcontent')

<div class="card shadow-sm p-4">
    <h3 class="text-success">Welcome Dr. {{ Auth::user()->full_name }}</h3>
    <p class="lead">Manage your appointments and patients efficiently.</p>
</div>

@endsection