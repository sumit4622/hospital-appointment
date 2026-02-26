@extends('admindashboard.layout')

@section('admincontent')

<div class="card shadow-sm p-3">
    <h3 class="text-success">Welcome {{ Auth::user()->full_name }}</h3>
    <hr>
    
</div>

@endsection