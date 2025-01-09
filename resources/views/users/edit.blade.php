@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Edit profile {{ $user->name }}</h1>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    
        <br>
        <form action="{{ route('user.update', $user->id) }}" method="POST" accept-charset="UTF-8">
            @csrf
            @method('PUT')

            <div class="mb-3" style="width: 23rem;">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3" style="width: 23rem;">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3" style="width: 23rem;">
                <label for="address" class="form-label">Address:</label>
                <input type="text" class="form-control" id="address" name="address"
                    value="{{ old('address', $user->address) }}" required>
                @error('address')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3" style="width: 23rem;">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @else
                    <small class="text-muted">Leave blank to keep the current password.</small>
                @enderror
            </div>

            <div class="mb-3" style="width: 23rem;">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit" class="btn btn-primary">Confirm</button>
        </form>

    
</div>
@endsection
