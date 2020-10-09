<?php

namespace App\Models;

use App\Casts\Image;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const IMAGE_PATH = 'categories';

    protected $fillable = ['title', 'image'];

    protected $casts = [
        'image' => Image::class
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }
}
