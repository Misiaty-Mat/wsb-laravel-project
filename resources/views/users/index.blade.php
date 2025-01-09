@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <h1>Users</h1>
        @forelse ($users as $user)
            <div id="user">
                <ul class="list-group" style="width: 20rem;">
                    <li class="list-group-item">Name: {{ $user->name }}</li>
                    <li class="list-group-item">Email: {{ $user->email }}</li>

                    <li class="list-group-item">Role:
                        <select class="roleSelect" name="role_select" user-id="{{ $user->id }}">
                            <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                            <option value="worker" {{ $user->role == 'worker' ? 'selected' : '' }}>Worker</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </li>
                    <li class="list-group-item">
                        <div class="btn-group">

                            <form action="{{ route('user.edit', $user->id) }}" method="POST">
                                @csrf
                                @method('GET')
                                <button type="submit" class="btn btn-primary me-2">Edit</button>
                            </form>

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger me-2">Delete</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
            <br>
        @empty
            <div class="alert alert-danger" role="alert">
                There are no pending orders
            </div>
        @endforelse
    </div>

    <script>
        const roleSelectInputs = document.getElementsByClassName('roleSelect');
        Object.values(roleSelectInputs).forEach(select => {
            select.addEventListener('change', function() {
                const selectedRole = this.value;
                const userId = this.getAttribute('user-id');

                if (selectedRole) {
                    fetch('/users/' + userId + '/' + selectedRole, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(res => location.reload());
                }
            });
        });
    </script>
@endsection
