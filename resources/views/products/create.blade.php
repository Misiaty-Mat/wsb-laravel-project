@extends('layouts.app')
<style>
    .card {
        text-align: center;
    }
</style>
@section('content')
    <div class="container">
    <h1>Create New Product</h1>
    <div class="card" style="width: 23rem;">
        <br>
        <form action="{{ route('products.store') }}" method="POST" accept-charset="UTF-8">
            @csrf

            <div>
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="product_name" required>
                @error('product_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div>
                <label for="price">Price:</label>
                <input type="number" step="0.01" value="0" min="0" id="price" name="price" required>
                @error('price')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div>
                <label for="stock">Stock:</label>
                <input type="number" value="0" min="0" id="stock" name="stock" required>
                @error('stock')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
        <br>
    </div>
</div>
@endsection
