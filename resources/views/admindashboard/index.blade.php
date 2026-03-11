@extends('admindashboard.layout')

@section('admincontent')
    <div class="card shadow-sm p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-success mb-0">Appointments list</h4>

            <div class="input-group shadow-sm" style="max-width: 400px; border-radius: 8px; overflow: hidden;">
                <form action="{{ route('admin.dashboard') }}" method="GET" class="d-flex shadow-sm"
                    style="max-width: 400px; border-radius: 8px; overflow: hidden;">
                    <div class="input-group">
                        <input type="search" name="role" id="roleSpecSearch" class="form-control border-0"
                            list="roleList" placeholder="Filter by role..." value="{{ request('role') }}" />

                        <datalist id="roleList">
                            <option value="Doctor"></option>
                            <option value="Patient"></option>
                        </datalist>

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
                @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="fw-bold">{{ $user->full_name }}</div>
                            <small class="text-muted">{{ ucfirst($user->role) }}</small>
                        </td>
                        <td>{{ $user->phone_number ?? 'N/A' }}</td>
                        <td>{{ $user->email }}</td>
                        <td class='gap-5'>
                            <a href="{{ route('admin.show.user', ['id' => $user->id]) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger text-white">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($users->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center text-muted">No records found for "{{ request('role') }}"</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
