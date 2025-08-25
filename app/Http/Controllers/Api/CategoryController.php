<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // Mengambil semua kategori, urut berdasarkan nama
        $categories = Category::orderBy('name', 'asc')->get();

        return response()->json([
            'success' => true,
            'message' => 'List Kategori',
            'data' => $categories,
        ]);
    }
}
