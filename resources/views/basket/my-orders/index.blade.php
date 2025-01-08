@extends('layouts.app')
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        h1 {margin-left: 120px;}
        #orders {margin-left: 120px;}
    </style>
  </head>
  <body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
@section('content')
    <div>
        <h1>My orders</h1>
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
