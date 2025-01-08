@extends('layouts.app')
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
@endsection

</html>
