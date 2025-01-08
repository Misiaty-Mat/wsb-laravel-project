@extends('layouts.app')
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
    h1 {text-align: center;}
    div {text-align: center;
    margin-left: auto;
    margin-right: auto;}
    </style>
  </head>
  <body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
@section('content')
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
@endsection
