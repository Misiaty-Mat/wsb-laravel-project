@extends('layouts.app')

@section('content')
    <div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <h1>Users</h1>
        @forelse ($users as $user)
            <div>
                <p>Name: {{ $user->name }}</p>
                <p>Email: {{ $user->email }}</p>

                Role:
                <select class="roleSelect" name="role_select" user-id="{{ $user->id }}">
                    <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="worker" {{ $user->role == 'worker' ? 'selected' : '' }}>Worker</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
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
