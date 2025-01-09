@extends('layouts.app')
@section('content')
    <h1>Edit product {{ $product->product_name }}</h1>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card" style="width: 23rem;">
        <br>
        <form action="{{ route('product.update', $product->id) }}" method="POST" accept-charset="UTF-8">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="product_name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="product_name" name="product_name"
                    value="{{ old('product_name', $product->product_name) }}" required>
                @error('product_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" min="0"
                    value="{{ old('price', $product->price) }}" required>
                @error('price')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Available stock:</label>
                <input type="number" class="form-control" id="stock" name="stock" min="0"
                    value="{{ old('stock', $product->stock) }}" required>
                @error('stock')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Confirm</button>
        </form>

    </div>
@endsection
