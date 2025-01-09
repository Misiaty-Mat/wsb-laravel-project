@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <h1>Pending orders</h1>
        @forelse ($baskets as $basket)
            <div id="list">
                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true">Product: {{ $basket->product->product_name }}
                    </li>
                    <li class="list-group-item">Client: {{ $basket->user->name }}</li>
                    <li class="list-group-item">Address: {{ $basket->user->address }}</li>
                    <li class="list-group-item">Email address: {{ $basket->user->email }}</li>
                    <li class="list-group-item">Quantity: {{ $basket->quantity }}</li>
                    <li class="list-group-item">Total price: {{ $basket->quantity * $basket->product->price }} zł</li>
                </ul>
                <form action="{{ route('basket.fulfill', $basket->id) }}" method="POST"
                    onsubmit="return confirm('Do you want to fulfill this order?');">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary" style="float: right; width: 12rem;">Fulfill</button>
                </form>
            </div>
            <br>
            <br>
        @empty
            <div class="alert alert-danger" style="margin-left: 120px; margin-right:120px;" role="alert">
                There are no pending orders
            </div>
        @endforelse
    </div>
@endsection
