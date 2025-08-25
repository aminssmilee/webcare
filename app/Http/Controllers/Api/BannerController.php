<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        // Ambil semua data banner dari database
        return response()->json(Banner::all());
    }
}
