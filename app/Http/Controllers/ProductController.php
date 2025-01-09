<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create($request->only(['product_name', 'description', 'price', 'stock']));

        return redirect()->route('product.index')->with('success', 'Product created successfully!');
    }

    public function edit($productId) {

        $product = Product::findOrFail($productId);
        return view('product.edit', compact('product'));

    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return abort(404);
        }

        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;

        $product->save();

        return redirect()->back()->with('success', "Successfully updated user " . $product->product_name);
    }

    public function destroy($productId)
    {
        Product::destroy($productId);

        return redirect()->back()->with('success', "Successfully deleted product");
    }
}
