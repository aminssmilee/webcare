<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'long_description',
        'price',
        'slug',
        'is_active',
        'category_id', // tambahkan ini
    ];

    // Relasi ke kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function specifications()
    {
        return $this->hasMany(ProductSpecification::class);
    }

    public function includes()
    {
        return $this->hasMany(ProductInclude::class);
    }

    public function features()
    {
        return $this->hasMany(ProductFeature::class);
    }
}
