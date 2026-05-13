@extends('admindashboard.layout')

@section('admincontent')
    <a href="{{ route('admin.dashboard') }}"
        class="btn btn-primary ">
        <i class="fas fa-users mb-2 fs-3"></i>
        <span class="fw-bold text-uppercase">Back</span>
    </a>
    <div class="card shadow-sm p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-success mb-0">doctor list</h4>

            <div class="input-group shadow-sm" style="max-width: 400px; border-radius: 8px; overflow: hidden;">
                <form action="{{ route('admin.dashboard.doctor') }}" method="GET" class="d-flex shadow-sm"
                    style="max-width: 400px; border-radius: 8px; overflow: hidden;">
                    <div class="input-group">
                        <input type="search" name="name" id="roleSpecSearch" class="form-control border-0"
                            list="roleList" placeholder="search here name ..." value="{{ request('name') }}" />


                        <button type="submit" class="btn btn-success border-0">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Phone number</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usersdoctor as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="fw-bold">{{ $user->full_name }}</div>
                            <small class="text-muted">{{ $user->role }}</small>
                        </td>
                        <td>{{ $user->phone_number ?? 'N/A' }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-link text-dark p-0" type="button"
                                    id="dropdownMenu{{ $user->id }}" data-bs-toggle="dropdown" aria-expanded="false"
                                    style="text-decoration: none;">
                                    <i class="bi bi-three-dots-vertical" style="font-size: 1.2rem;"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end shadow"
                                    aria-labelledby="dropdownMenu{{ $user->id }}">

                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('admin.show.appoiment', ['id' => $user->id]) }}">
                                            <i class="fas fa-calendar-check text-primary me-2"></i> View Appointment
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('admin.show.user', ['id' => $user->id]) }}">
                                            <i class="fas fa-user-edit text-info me-2"></i> Edit User
                                        </a>
                                    </li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    <li>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-trash-alt me-2"></i> Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach

                @if ($usersdoctor->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center text-muted">No records found for "{{ request('role') }}"</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
