<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BasketController extends Controller
{

    public function index()
    {
        $baskets = Basket::where('user_id', auth()->id())
        ->where('is_purchased', false)
        ->with('product')
        ->get();
        return view('basket.index', compact('baskets'));
    }

    public function fulfillIndex()
    {
        $baskets = Basket::where('is_purchased', true)
        ->where('is_fulfilled', false)
        ->with('product')
        ->get();
        return view('basket.fulfill.index', compact('baskets'));
    }

    public function fulfill($id)
    {
        $basket = Basket::findOrFail($id);
        $basket->is_fulfilled = true;
        $basket->save();

        return redirect()->back()->with('success', 'Order for ' . $basket->user->name . ' was finished');
    }

    public function myOrders()
    {
        $baskets = Basket::where('user_id', auth()->id())
        ->where('is_purchased', true)
        ->with('product')
        ->get();
        return view('basket.my-orders.index', compact('baskets'));
    }

    public function store(Request $request)
    {
        Basket::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'quantity' => 1
        ]);

        $addedPorduct = Product::find($request->product_id);

        return redirect()->back()->with('success', $addedPorduct->product_name . ' was added to a basket');
    }

    public function confirm(Request $request)
    {
        $filteredRequest = $request->except(['_token', '_method']);

        foreach ($filteredRequest as $basket_id => $quantity) {
            $basket = Basket::findOrFail($basket_id);
            $product = $basket->product;

            $basket->quantity = $quantity;
            $basket->is_purchased = true;

            $product->stock = $product->stock - $quantity;

            $product->save();
            $basket->save();
        }

        return redirect()->route('products.index')->with('success', 'Thank you for your purchase');
    }

    public function destroy($productId)
    {
        $basket = Basket::where('user_id', auth()->id())
        ->where('product_id', $productId)
        ->first();

        $basket->delete();

        $removedPorduct = Product::find($productId);

        return redirect()->back()->with('success', $removedPorduct->product_name . ' was removed from your basket');
    }
}
