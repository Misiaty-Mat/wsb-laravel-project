@extends('layouts.app')

@section('content')
    <div>
        <h1>My orders</h1>
        @forelse ($baskets as $basket)
            <div>
                <strong>{{ $basket->product->product_name }}</strong><br>
                <p>{{ $basket->product->price }} zł x {{ $basket->quantity }}</p>
                <p>Status: {{ $basket->is_fulfilled ? 'Fulfilled' : 'On the way' }}</p>
            </div>
        @empty
            <div class="alert alert-danger" role="alert">
                You do not have any orders! Please go back and find something you like!
            </div>
        @endforelse
    </div>
@endsection
