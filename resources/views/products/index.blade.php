@extends('layouts.app')
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
    h1 {margin-left: 120px;}
    #product {margin-left: 120px;}
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
        <h1>List of products</h1>
        @foreach ($products as $product)
                <div class="card" id= "product" style="width: 18rem;">
                <div class="card-body">
                <h3 class="card-title">{{ $product->product_name }}</h3>
                <p class="card-text">Description: {{ $product->description }}<br>
                    Price: {{ $product->price }} zł<br>
                    Stock: {{ $product->stock }}<br>
                    </p>
                    @auth
                        @if ($product->isInABasketOfCurrentUser())
                            <form action="{{ route('basket.destroy', $product->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to remove this product from your basket?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove from basket</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('basket.store', ['product_id' => $product->id]) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">Add to basket</button>
                            </form>
                        @endif
                    @endauth
                    </div>
                </div>
                <br>
        @endforeach
    </div>
    </body>
@endsection
</html>