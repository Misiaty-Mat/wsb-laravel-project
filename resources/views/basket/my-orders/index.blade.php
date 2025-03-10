@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>My orders</h1>
        @forelse ($baskets as $basket)
            <div class="card border-success mb-3" id="orders">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>{{ $basket->product->product_name }}</strong></li>
                    <li class="list-group-item">{{ $basket->product->price }} zł x {{ $basket->quantity }}</li>
                </ul>
                <div class="card-footer text-success">Status: {{ $basket->is_fulfilled ? 'Fulfilled' : 'On the way' }}</div>
            </div>
            <br>
        @empty
            <div class="alert alert-danger" role="alert">
                You do not have any orders! Please go back and find something you like!
            </div>
        @endforelse
    </div>
@endsection
