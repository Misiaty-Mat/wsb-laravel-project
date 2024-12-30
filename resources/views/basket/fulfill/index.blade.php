@extends('layouts.app')

@section('content')
    <div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <h1>Pending orders</h1>
        @forelse ($baskets as $basket)
            <div>
                <p>Client: {{ $basket->user->name }}</p>
                <p>Address: {{ $basket->user->address }}</p>
                <p>Email address: {{ $basket->user->email }}</p>
                <p>Product: {{ $basket->product->product_name }}</p>
                <p>Quantity: {{ $basket->quantity }}</p>
                <p>Total price: {{ $basket->quantity * $basket->product->price }}</p>
                <form action="{{ route('basket.fulfill', $basket->id) }}" method="POST"
                    onsubmit="return confirm('Do you want to fulfill this order?');">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Fulfill</button>
                </form>
            </div>
        @empty
            <div class="alert alert-danger" role="alert">
                There are no pending orders
            </div>
        @endforelse
    </div>
@endsection
