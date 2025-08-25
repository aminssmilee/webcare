<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInclude extends Model
{
    protected $fillable = ['product_id', 'item'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}