<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id', 'title', 'slug', 'description', 'price', 'barcode', 'stock', 'cover'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function gallery()
    {
        return $this->hasOne(Gallery::class);
    }
}
