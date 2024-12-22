<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // pobierz wszystkie produkty
        return view('products.index', compact('products')); // prześlij dane do widoku
    }
}
