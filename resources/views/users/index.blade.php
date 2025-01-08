@extends('layouts.app')
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        h1 {margin-left: 120px;}
        #user {margin-left: 120px;}
    </style>
  </head>
  <body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
@section('content')
    <div>
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
                </select></li>
                </ul>
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
