<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'code',
        'slug',
        'summary',
        'description',
        'price',
        'image',
        'is_active',
        'category_id',
    ];
    protected static function booted()
    {
        static::creating(function($product){
            $product->slug = Str::slug($product->name);
        });

        static::updating(function($product){
            $product->slug = Str::slug($product->name);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
