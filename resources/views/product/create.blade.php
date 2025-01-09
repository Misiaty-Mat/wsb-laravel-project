@extends('layouts.app')
<style>
    h1 {
        text-align: center;
    }
    .card {
        text-align: center;
        margin: 0 auto;
        float: none;
    }
</style>
@section('content')
    <div class="container">
        <h1>Create New Product</h1>
            <div class="card" style="width: 23rem;">
                <br>
                <form action="{{ route('product.store') }}" method="POST" accept-charset="UTF-8">
                    @csrf
                    <div class="mx-auto p-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-secondary text-white">Product Name:</span>
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                            @error('product_name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        </div> 
                    <br>
                    <div class="mx-auto p-2">
                        <div class="input-group mb-3" style="width: 10rem;">
                            <span class="input-group-text bg-secondary text-white">Price:</span>
                            <input type="number" class="form-control" step="0.01" value="0" min="0" id="price" name="price"
                                required>
                            @error('price')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="mx-auto p-2">
                        <div class="input-group mb-3" style="width: 10rem;">
                            <span class="input-group-text bg-secondary text-white">Stock:</span>
                            <input type="number" class="form-control" value="0" min="0" id="stock" name="stock" required>
                            @error('stock')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="mx-auto p-2">
                        <div class="input-group">
                            <span class="input-group-text bg-secondary text-white">Description:</span>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
                <br>
            </div>
    </div>
@endsection
