<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function addToBasket(Request $request)
    {
        // Walidacja danych wejściowych
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Dodanie produktu do koszyka
        Basket::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'is_purchased' => false,
            'is_fulfilled' => false,
        ]);

        return response()->json(['message' => 'Produkt dodany do koszyka.'], 200);
    }
}