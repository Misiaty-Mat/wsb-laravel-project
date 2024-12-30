<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'stock'

    ];

    protected $table = 'product';

    public function baskets()
    {
        return Basket::where('product_id', $this->id);
    }

    public function isInABasketOfCurrentUser() {

        $user = auth()->user();
        return $this->baskets()
        ->where('user_id', $user->id)
        ->where('is_purchased', false)
        ->exists();
    }
}
