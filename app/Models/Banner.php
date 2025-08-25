<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori',
        'judul',
        'headline',
        'deskripsi',
        'gambar',
        'link'
    ];

    public function getImageUrlAttribute()
    {
        return asset('storage/banners/' . $this->gambar);
    }
}
