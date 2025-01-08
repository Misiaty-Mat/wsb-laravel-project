@extends('layouts.app')
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
    h1 {margin-left: 120px;}
    #list {margin-left: 120px;
    margin-right:120px;}
    button {float: right;}
    #pending {margin-left: 120px;
        margin-right:120px;}
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
        <h1>Pending orders</h1>
        @forelse ($baskets as $basket)
            <div id="list">
            <ul class="list-group">
            <li class="list-group-item active" aria-current="true">Product: {{ $basket->product->product_name }}</li>
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
                    <button type="submit" class="btn btn-primary" style="width: 12rem;">Fulfill</button>
                </form>
            </div>
            <br>
            <br>
        @empty
            <div class="alert alert-danger" id="pending" role="alert">
                There are no pending orders
            </div>
        @endforelse
    </div>
@endsection
