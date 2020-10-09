<?php

namespace App\Models;

use App\Casts\Image;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const IMAGE_PATH = 'products';

    protected $fillable = ['title', 'category_id', 'description', 'price', 'image'];

    protected $casts = [
        'image' => Image::class,
        'price' => 'float'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
