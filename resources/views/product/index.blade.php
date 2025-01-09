@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <h1>List of products</h1>
        @foreach ($products as $product)
            <div class="grid gap-3">
                <div class="p-2 g-col-6">
                    <div class="card" id= "product" style="width: 18rem;">
                        <div class="card-body">
                            <h3 class="card-title">{{ $product->product_name }}</h3>
                            <p class="card-text">Description: {{ $product->description }}</p>
                            <p class="card-text">Price: {{ $product->price }} zł</p>
                            <p class="card-text">Stock: {{ $product->stock }}</p>
                            <div class="btn-group">
                                @auth
                                    @if ($product->isInABasketOfCurrentUser())
                                        <form action="{{ route('basket.destroy', $product->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to remove this product from your basket?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Remove from basket</button>
                                        </form>
                                    @else
                                        <form method="POST"
                                            action="{{ route('basket.store', ['product_id' => $product->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-primary me-2">Add to basket</button>
                                        </form>

                                        @if (in_array(Auth::user()->role, ['admin', 'worker']))
                                            <form action="{{ route('product.edit', $product->id) }}" method="POST">
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="btn btn-primary me-1">Edit</button>
                                            </form>

                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger me-1">Delete</button>
                                            </form>
                                        @endif
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

</html>
