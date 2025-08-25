<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with([
            'images',
            'specifications',
            'includes',
            'features',
            'category'
        ])->get();

        return response()->json([
            'success' => true,
            'message' => 'List Produk',
            'data' => $products
        ], 200);
    }

    public function show($id)
    {
        $product = Product::with([
            'images',
            'specifications',
            'includes',
            'features'
        ])->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Produk',
            'data' => $product
        ]);
    }
}
