@extends('layouts.app')
@section('content')
    <div>
        <h1 style="margin-left: 120px;">My orders</h1>
        @forelse ($baskets as $basket)
            <div class="card" id="orders" style="width: 30rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>{{ $basket->product->product_name }}</strong></li>
                    <li class="list-group-item">{{ $basket->product->price }} zł x {{ $basket->quantity }}</li>
                </ul>
                <div class="card-footer">Status: {{ $basket->is_fulfilled ? 'Fulfilled' : 'On the way' }}</div>
            </div>
            <br>
        @empty
            <div class="alert alert-danger" role="alert">
                You do not have any orders! Please go back and find something you like!
            </div>
        @endforelse
    </div>
@endsection
